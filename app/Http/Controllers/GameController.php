<?php

namespace App\Http\Controllers;

use App\Contracts\NumberGeneratorInterface;
use App\Contracts\ScoreTrackerInterface;
use App\Http\Requests\GuessRequest;
use App\Http\Requests\StartGameRequest;
use App\Http\Services\GameService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private $numberGenerator;
    private $scoreTracker;
    protected $gameService;

    public function __construct(
        NumberGeneratorInterface $numberGenerator,
        ScoreTrackerInterface    $scoreTracker,
        GameService              $gameService
    )
    {
        $this->numberGenerator = $numberGenerator;
        $this->scoreTracker = $scoreTracker;
        $this->gameService = $gameService;
    }

    public function index()
    {
        return view('index');
    }

    public function startNewGame()
    {
        session()->flush();
        return redirect()->route('index');
    }

    public function play()
    {
        $userId = session('user_id');
        $userScores = $this->scoreTracker->getUserScore($userId);
        return view('game', [
            'userScores' => $userScores,
        ]);
    }

    public function start(StartGameRequest $request)
    {
        $user = User::firstOrCreate(
            $request->validated()
        );

        session(['user_id' => $user->id]);

        $number = $this->numberGenerator->generateNumber();

        session(['target_number' => $number, 'attempts' => 0]);

        return redirect()->route('game.play');
    }

    public function guess(GuessRequest $request)
    {
        $guess = $request->input('guess');

        session(['attempts' => session('attempts') + 1]);

        if ($guess === session('target_number')) {
            return $this->finish(true);
        }

        $result = $this->gameService->calculateCowsAndBulls($guess, session('target_number'));

        return response()->json(['result' => $result, 'attempts' => session('attempts')]);
    }

    public function finish($gameWon = false)
    {

        if ($gameWon) {
            $this->gameService->store(session('user_id'), session('attempts'));
            session(['attempts' => 0, 'target_number' => null, 'game_started' => false]);
            return response()->json(['message' => 'Congratulations! You guessed the number!']);
        }

        session(['attempts' => 0, 'target_number' => null, 'game_started' => false]);
        return response()->json(['message' => 'Game finished! You have given up!']);
    }
}

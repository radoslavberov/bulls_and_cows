<?php

namespace App\Http\Controllers;

use App\Contracts\GuessValidatorInterface;
use App\Contracts\NumberGeneratorInterface;
use App\Contracts\ScoreTrackerInterface;
use App\Http\Requests\StartGameRequest;
use App\Http\Services\GameService;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private $numberGenerator;
    private $guessValidator;
    private $scoreTracker;
    protected $gameService;

    public function __construct(
        NumberGeneratorInterface $numberGenerator,
        GuessValidatorInterface $guessValidator,
        ScoreTrackerInterface $scoreTracker,
        GameService $gameService
    ) {
        $this->numberGenerator = $numberGenerator;
        $this->guessValidator = $guessValidator;
        $this->scoreTracker = $scoreTracker;
        $this->gameService = $gameService;
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

    public function guess(Request $request)
    {
        if (!$this->guessValidator->validateGuess($request->input('guess'))) {
            return back()->withErrors(['Invalid guess. Please enter four unique digits.']);
        }

        session(['attempts' => session('attempts') + 1]);

        if ($request->input('guess') === session('target_number')) {
            return $this->finish(true);
        }

        $result = $this->gameService->calculateCowsAndBulls($request->input('guess'), session('target_number'));

        return response()->json(['result' => $result, 'attempts' => session('attempts')]);
    }

    public function finish(Request $request, $gameWon = false)
    {

        if ($request->input('guess') === session('target_number')) {
            $this->gameService->store(session('user_id'), session('attempts'));
        }

        session(['attempts' => 0, 'target_number' => null]);

        if ($gameWon) {
            return response()->json(['message' => 'Congratulations! You guessed the number!']);
        }

        return response()->json(['message' => 'Game finished!']);
    }
}

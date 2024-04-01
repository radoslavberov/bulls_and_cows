<?php

namespace App\Http\Controllers;

use App\Contracts\GuessValidatorInterface;
use App\Contracts\NumberGeneratorInterface;
use App\Contracts\ScoreTrackerInterface;
use App\Http\Requests\StartGameRequest;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private $numberGenerator;
    private $guessValidator;
    private $scoreTracker;

    public function __construct(
        NumberGeneratorInterface $numberGenerator,
        GuessValidatorInterface $guessValidator,
        ScoreTrackerInterface $scoreTracker
    ) {
        $this->numberGenerator = $numberGenerator;
        $this->guessValidator = $guessValidator;
        $this->scoreTracker = $scoreTracker;
    }
    public function play()
    {
        return view('game');
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

        $result = $this->calculateCowsAndBulls($request->input('guess'), session('target_number'));

        return response()->json(['result' => $result, 'attempts' => session('attempts')]);
    }

    public function finish($gameWon = false)
    {
        $userId = session('user_id');
        $attempts = session('attempts');

        if ($attempts > 0 || $gameWon) {
            $game = new Game();
            $game->user_id = $userId;
            $game->attempts = $attempts;
            $game->save();
        }

        session(['attempts' => 0, 'target_number' => null]);

        if ($gameWon) {
            return response()->json(['message' => 'Congratulations! You guessed the number!']);
        }

        return response()->json(['message' => 'Game finished!']);
    }

    private function calculateCowsAndBulls(string $guess, string $targetNumber): array
    {
        $bulls = 0;
        $cows = 0;

        for ($i = 0; $i < strlen($guess); $i++) {
            if ($guess[$i] == $targetNumber[$i]) {
                $bulls++;
            } elseif (in_array($guess[$i], str_split($targetNumber))) {
                $cows++;
            }
        }

        return ['bulls' => $bulls, 'cows' => $cows];
    }
}

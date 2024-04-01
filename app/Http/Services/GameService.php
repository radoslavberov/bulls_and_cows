<?php

namespace App\Http\Services;

use App\Models\Game;

class GameService
{
    public function store($userId, $attempts): Game
    {
        return Game::create([
            'user_id' => $userId,
            'attempts' => $attempts
        ]);
    }

    public function calculateCowsAndBulls(string $guess, string $targetNumber): array
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

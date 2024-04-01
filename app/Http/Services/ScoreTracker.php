<?php

namespace App\Http\Services;

use App\Contracts\ScoreTrackerInterface;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class ScoreTracker implements ScoreTrackerInterface
{

    public function getUserScore($userId): array
    {
        return Game::where('user_id', $userId)
            ->orderBy('attempts', 'asc')
            ->get()
            ->toArray();
    }

    public function getTopScores(int $limit = 10): array
    {
        return Game::select('user_id', DB::raw('MIN(attempts) as best_attempt'))
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('best_attempt', 'asc')
            ->take($limit)
            ->get()
            ->toArray();
    }
}

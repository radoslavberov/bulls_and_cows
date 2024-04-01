<?php

namespace App\Contracts;

interface ScoreTrackerInterface
{
    public function getUserScore(string $userId): array;
    public function getTopScores(int $limit = 10): array;
}

<?php

namespace App\Contracts;

interface GuessValidatorInterface
{
    public function validateGuess(string $guess): bool;
}

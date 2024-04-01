<?php

namespace App\Http\Services;

use App\Contracts\GuessValidatorInterface;

class GuessValidator implements GuessValidatorInterface
{

    public function validateGuess(string $guess): bool
    {
        return $this->isFourDigits($guess) && $this->containsOnlyDigits($guess) && $this->hasUniqueDigits($guess);
    }

    private function isFourDigits(string $guess): bool
    {
        return strlen($guess) === 4;
    }

    private function containsOnlyDigits(string $guess): bool
    {
        return ctype_digit($guess);
    }

    private function hasUniqueDigits(string $guess): bool
    {
        $digits = str_split($guess);
        return count($digits) === count(array_unique($digits));
    }
}

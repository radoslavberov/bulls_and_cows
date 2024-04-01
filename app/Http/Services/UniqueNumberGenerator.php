<?php

namespace App\Http\Services;

use App\Contracts\NumberGeneratorInterface;

class UniqueNumberGenerator implements NumberGeneratorInterface
{

    private $number = '';
    private $validNumbers = '0123456789';
    private $evenNumbers = [4, 5];
    private $couples = [1 => 8, 8 => 1];

    public function generateNumber(): string
    {
        $this->reset();
        while (strlen($this->number) < 4) {
            $num = $this->validNumbers[random_int(0, strlen($this->validNumbers) - 1)];

            if (in_array($num, $this->evenNumbers) && (strlen($this->number) % 2 == 0)) {
                continue;
            }

            if (array_key_exists($num, $this->couples)) {
                $this->number .= $num . $this->couples[$num];
            } else {
                $this->number .= $num;
            }

            $this->validNumbers = str_replace($num, '', $this->validNumbers);
            if (array_key_exists($num, $this->couples)) {
                $this->validNumbers = str_replace($this->couples[$num], '', $this->validNumbers);
            }
        }

        return $this->number;
    }

    private function reset()
    {
        $this->number = '';
        $this->validNumbers = '0123456789';
    }
}

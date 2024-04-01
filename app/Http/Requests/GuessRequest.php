<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuessRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'guess' => ['required', 'digits:4', 'regex:/^(?!.*(.).*\1)\d+$/'],
        ];
    }

    public function messages()
    {
        return [
            'guess.required' => 'A guess is required.',
            'guess.digits' => 'The guess must be exactly four digits long.',
            'guess.regex' => 'The guess must contain unique digits.',
        ];
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidPostcode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validPostcode = Http::get('https://api.postcodes.io/postcodes/' . $value . '/validate');
        if (!$validPostcode->json('result')) {
            $fail('The :attribute is not valid.');
        }

    }
}

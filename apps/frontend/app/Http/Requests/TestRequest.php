<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    /**
     * Retrieves an array of validation rules for the email field.
     *
     * @return array<string, array<string>> An array containing the validation rules for the email field.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
        ];
    }
}

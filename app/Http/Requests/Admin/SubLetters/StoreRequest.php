<?php

namespace App\Http\Requests\Admin\SubLetters;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'letter' => ['required', 'string', 'max:1'],
            'status' => ['required', 'string', 'max:1'],
        ];
    }
}
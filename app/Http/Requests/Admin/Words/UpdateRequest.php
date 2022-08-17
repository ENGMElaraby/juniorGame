<?php

namespace App\Http\Requests\Admin\Words;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
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
            'word' => ['required', 'string', 'max:20'],
            'image' => ['sometimes', 'image'],
            'voice' => ['sometimes', 'file'],
            'letter_id' => ['sometimes'],
        ];
    }
}
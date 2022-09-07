<?php

namespace App\Http\Requests\Admin\Questions;

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
            'letter_id' => ['required'],
            'title' => ['nullable', 'string', 'max:190'],
            'image' => ['required', 'image'],
            'voice' => ['nullable', 'file'],
            'correct' => ['nullable'],
            'answers' => ['array'],
        ];
    }
}
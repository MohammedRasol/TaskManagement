<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); //only authenticated users can submit
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'], // String, required, max length 255
            'description' => ['nullable', 'string'], // Optional, must be string if provided
            'status' => ['nullable', Rule::in(['pending', 'completed', 'canceled'])], // Optional, must be one of the enum values
            'completed_at' => ['nullable', 'date'], // Optional, must be a valid date if provided
        ];
    }
}

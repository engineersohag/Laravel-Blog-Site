<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'The comment field is required.',
            'comment.string' => 'The comment must be a string.',
            'comment.max' => 'The comment may not be greater than 1000 characters.',

            'parent_id.integer' => 'The parent ID must be a valid number.',
            'parent_id.exists' => 'The selected parent comment does not exist.',
        ];
    }

}

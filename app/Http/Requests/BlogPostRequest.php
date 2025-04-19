<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,|max:2048',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Blog title is required.',
            'category.required' => 'Please select a category.',
            'category.exists' => 'Selected category is invalid.',
            'image.image' => 'Uploaded file must be an image.',
            'description.required' => 'Please provide a description.',
        ];
    }
}

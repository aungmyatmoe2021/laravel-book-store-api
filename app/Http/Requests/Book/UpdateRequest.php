<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'sometimes|string|max:255|unique:books,title'.$this->route('book'),
            'cover_image_url'=>'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'sometimes|string',
            'category_id'=>'sometimes|exists:categories,id'
        ];
    }
}

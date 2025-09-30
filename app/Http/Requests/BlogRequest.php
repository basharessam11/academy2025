<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255|min:3',
            'title_en' => 'required|string|max:255|min:3',
            'tag_ar' => 'required|string|max:500|min:3',
            'tag_en' => 'required|string|max:500|min:3',
            'user_id' => 'required|exists:users,id',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }
}

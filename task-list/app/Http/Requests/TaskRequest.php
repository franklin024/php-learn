<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            "title" => "required|max:255",
            "description" => "required",
            "long_description" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'đừng bỏ trống!',
            'title.max' => 'tối đa 255 ký tự',
            'description.required' => 'đừng bỏ trống!',
            'long_description.required' => 'đừng bỏ trống!'
        ];
    }
}

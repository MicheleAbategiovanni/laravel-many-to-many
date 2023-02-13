<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|min:10|max:255",
            "description" => "required|string",
            "thumb" => "required|image|max:1024",
            "github_link" => "string|url",
            "technologies" => "nullable|array|exists:technologies,id"
        ];
    }
}

<?php

namespace App\Http\Requests\Blog;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'title' => 'Required|string',
            'description' => 'Required|string',
            'image'=> 'Required|image',
            'tag.*' => 'integer|nullable|exists:tags,id',
        ];
    }
}

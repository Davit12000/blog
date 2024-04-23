<?php

namespace App\Http\Requests\Blog;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->blog)? Response::allow()
        : Response::deny('You do not own this post.');;
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

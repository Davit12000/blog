<?php

namespace App\Http\Requests\Comment;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): Response
    {
       return $this->user()->can('update', $this->comment)? Response::allow()
       : Response::deny('You do not own this Comment.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'string|required|max:250'
        ];
    }
}

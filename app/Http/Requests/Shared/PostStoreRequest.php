<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            "title"=> ["required","integer","exists:post_types,id"],
            "number" => ["required","integer","between:1,100"],
            "notes" => ["required","string"],
            "amount" => ["required","regex:/^\d+(\.\d{1,2})?$/"],
        ];
    }
}

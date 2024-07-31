<?php

namespace App\Http\Requests\Shared;

use App\Models\PostType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

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
            "title" => ["required", "integer", "exists:post_types,id"],
            "number" => ["required", "integer", "between:1,100"],
            "notes" => ["required", "string"],
            "date" => ["required", "date", "after_or_equal:today"],
            "amount" => ["required", "regex:/^\d+(\.\d{1,2})?$/"],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $postTime = $this->date.' '.PostType::find($this->title)->schedule_time;
            
            if ($postTime < Date::now()->subUTCMinute(5)->format("Y-m-d H:i:s")) {
                $validator->errors()->add('error', 'Post time of this title has been closed for today!');
            }
        });
    }
}

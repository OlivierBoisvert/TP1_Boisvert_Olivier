<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        'first_name' => 'required|string|max:50',
        'last_name'  => 'required|string|max:50',
        //Chatgpt "How could I add a unique rule to my api validation
        'email'      => 'required|string|email|max:50|unique:users,email,'.$this->id,
        'phone'      => 'required|string|max:12'
    ];
    }
}

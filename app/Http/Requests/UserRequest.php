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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "user_role" => 'required|numeric',
            "name"      => 'required|max:32',
            "username"  => 'required|unique:users|max:32',
            "email"     => 'required|email|unique:users',
            "password"  => 'required|confirmed',
            "image"     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}

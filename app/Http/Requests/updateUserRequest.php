<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            //"username"  => 'required|max:32|unique:users,username,' . $this->user->id,
            //"email"     => 'required|email|unique:users,email,'. $this->user->id,
            "username"  => ['required', 'max:32', Rule::unique('users')->ignore($this->user)],
            "email"     => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            "password"  => 'confirmed',
            "image"     => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}

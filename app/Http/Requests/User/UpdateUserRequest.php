<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules() : array
    {
        $user = $this->user;

        return [
            'name' => 'string',
            'email' => [
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($user->email, 'email')
            ],
            'password' => 'string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => [
                'required',
                Rule::exists('roles', 'id'),
            ]
        ];
    }
}
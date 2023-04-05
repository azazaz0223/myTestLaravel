<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules() : array
    {
        $role = $this->role;

        return [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->name, 'name')
            ],
            'permissions' => 'required|array',
            'permissions.*' => [
                'required',
                Rule::exists('permissions', 'id')
            ]
        ];
    }
}
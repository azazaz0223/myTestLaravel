<?php

namespace App\Http\Requests\Cate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCateRequest extends FormRequest
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
        $cate = $this->cate;

        return [
            'name' => [
                'max:50',
                Rule::unique('cates', 'name')->ignore($cate->name, 'name')
            ],
            'sort' => 'nullable|integer'
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|min:3|max:50',
            'guard' => 'required|string|in:super',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Role name'),
            'guard' => __('Guard name'),
        ];
    }
}

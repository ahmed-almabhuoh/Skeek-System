<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserFromSuperRequest extends FormRequest
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
            'email' => 'required|email|min:9|max:50|unique:admins,email',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->uncompromised()],
            'active' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password',
            'active' => 'User status',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->toBoolean($this->active),
        ]);
    }

    // Convert boolean to be validationable
    private function toBoolean($booleanable)
    {
        return filter_var($booleanable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}

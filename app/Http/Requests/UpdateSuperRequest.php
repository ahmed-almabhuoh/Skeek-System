<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;

class UpdateSuperRequest extends FormRequest
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
            'email' => 'required|string|min:9|max:50|unique:supers,email,' . Crypt::decrypt($this->id),
            'password' => ['nullable', 'string', Password::min(8)->letters()->numbers()->uncompromised()],
            'active' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Super name'),
            'email' => __('Super email'),
            'password' => __('Super password'),
            'active' => __('Super status'),
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

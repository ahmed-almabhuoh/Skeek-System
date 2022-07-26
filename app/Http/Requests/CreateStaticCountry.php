<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStaticCountry extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:45', 'unique:static_countries,name'],
            'active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            // Name input
            'name.required' => 'Enter country name please.',
            'name.string' => 'Country name is in-valid name.',
            'name.min' => 'Enter a valid country name',
            'name.max' => 'Larg country name, re-enter a valid country name.',

            // Active input
            'active.required' => 'Invalid active state, re-enter state of country',
            'active.boolean' => 'Country state must to be active or in-active',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Country name',
            'active' => 'Country state',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCountryRequest extends FormRequest
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


    // protected $stopOnFirstFailure = true;

    // To redirect user to spacific location with URI
    // protected $redirect = '/check-system/countries/create';

    // To redirect user to spacific location with named route
    // protected $redirectRoute = 'countries.create';

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->somethingElseIsInvalid()) {
    //             $validator->errors()->add('field', 'Something is wrong with this field!');
    //         }
    //     });
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'string', 'min:3', 'max:45', Rule::unique('countries')->where(function ($query) {
                $query->where('admin_id', auth('admin')->user()->id);
            })],
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

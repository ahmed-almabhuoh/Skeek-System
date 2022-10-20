<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCurrancyRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20|unique:currancies,name',
            'active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Please, enter the currancy name'),
            'name.string' => __('Currancy name have to be string'),
            'name.min' => __('Currancy name must contain at least 3 character'),
            'name.unique' => __('Currancy you try to create was created before'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Currancy name'),
            'active' => __('Currancy status'),
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

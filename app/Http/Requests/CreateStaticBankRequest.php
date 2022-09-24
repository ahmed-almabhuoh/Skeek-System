<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStaticBankRequest extends FormRequest
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

    public function messages()
    {
        return [
            // Sheek image input
            'image.max' => 'File is too large, try agian.',
            'currancy_id.exists' => 'Invalid currancy entered',
            'country_id.exists' => 'Invalid country entered',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Bank name'),
            'city' => __('Bank city'),
            'country_id' => __('Bank country'),
            'image' => __('Bank sheek image'),
            'active' => __('Bank status'),
            'currancy_id' => __('Currancy'),
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|min:3|max:50|unique:static_bank,name',
            'country_id' => 'required|integer|exists:static_countries,id',
            'city' => 'required|string|min:3|max:50',
            'image' => 'required|image|mimes:png,jpg,jpeg|dimensions:min_width=600,min_height=270,max_width=620,max_height=280|max:2048',
            'active' => 'required|boolean',
            'currancy_id' => 'required|integer|exists:currancies,id',
        ];
    }
}

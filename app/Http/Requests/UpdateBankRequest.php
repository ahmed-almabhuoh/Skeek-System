<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:45',
            'city' => 'required|string|min:3|max:45',
            // 'sheek_image' => 'required|image|max:2048|mimes:jpg,png',
            'sheek_image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif|dimensions:min_width=600,min_height=270,max_width=620,max_height=280',
            // 'sheek_image' => 'required',
            'active' => 'required|boolean',
            'country_id' => 'nullable|exists:countries,id',
            'currancy_id' => 'required|integer|exists:currancies,id',
        ];
    }

    public function messages()
    {
        return [
            // Sheek image input
            'sheek_image.max' => __('File is too large, try agian.'),

            'currancy_id.exists' => __('Invalid currancy entered'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Bank name'),
            'City' => __('Bank city'),
            'country_id' => __('Bank country'),
            'sheek_image' => __('Bank sheek image'),
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
}

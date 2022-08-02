<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBankRequest extends FormRequest
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
        if ($this->static_country_id == 0 && $this->country_id != 0) {
            return [
                //
                'name' => ['required', 'string', 'min:3', 'max:45', Rule::unique('banks')->where(function ($query) {
                    $query->where([
                        ['admin_id', auth('admin')->user()->id],
                        ['city', $this->city],
                    ]);
                })],
                'city' => 'required|string|min:3|max:45',
                // 'sheek_image' => 'required|image|max:2048|mimes:jpg,png',
                'sheek_image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif|dimensions:min_width=600,min_height=270,max_width=620,max_height=280',
                // 'sheek_image' => 'required',
                'active' => 'required|boolean',
                'country_id' => 'nullable|integer|exists:countries,id',
                'currancy_id' => 'required|integer|exists:currancies,id'
            ];
        } else if ($this->static_country_id != 0 && $this->country_id == 0) {
            return [
                //
                'name' => ['required', 'string', 'min:3', 'max:45', Rule::unique('banks')->where(function ($query) {
                    $query->where([
                        ['admin_id', auth('admin')->user()->id],
                        ['city', $this->city],
                    ]);
                })],
                'city' => 'required|string|min:3|max:45',
                // 'sheek_image' => 'required|image|max:2048|mimes:jpg,png',
                'sheek_image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif|dimensions:min_width=600,min_height=270,max_width=620,max_height=280',
                // 'sheek_image' => 'required',
                'active' => 'required|boolean',
                'static_country_id' => 'nullable|integer|exists:static_countries,id',
                'currancy_id' => 'required|integer|exists:currancies,id'
            ];
        } else {
            return [
                //
                'name' => ['required', 'string', 'min:3', 'max:45', Rule::unique('banks')->where(function ($query) {
                    $query->where([
                        ['admin_id', auth('admin')->user()->id],
                        ['city', $this->city],
                    ]);
                })],
                'city' => 'required|string|min:3|max:45',
                // 'sheek_image' => 'required|image|max:2048|mimes:jpg,png',
                'sheek_image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif|dimensions:min_width=600,min_height=270,max_width=620,max_height=280',
                // 'sheek_image' => 'required',
                'active' => 'required|boolean',
                'country_id' => 'nullable|integer|exists:countries,id',
                'static_country_id' => 'nullable|integer|exists:static_countries,id',
                'currancy_id' => 'required|integer|exists:currancies,id'
            ];
        }
    }

    public function messages()
    {
        return [
            // Sheek image input
            'sheek_image.max' => 'File is too large, try agian.',


            // Static Countries
            'static_country_id.integer' => 'Invalid country number',
            'static_country_id.exists' => 'Invalid country number',

            // Currancy
            'currancy_id.exsits' => 'Invalid currancy entered',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Bank name',
            'City' => 'Bank city',
            'country_id' => 'Bank country',
            'sheek_image' => 'Bank sheek image',
            'active' => 'Bank state',
            'static_country_id' => 'Static Country',
            'currancy_id' => 'Currancy',
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

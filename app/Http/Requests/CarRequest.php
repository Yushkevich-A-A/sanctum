<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarRequest extends FormRequest
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
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'price' => ['integer']
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => 'A brand is required',
            'model.required' => 'A model is required',
            'brand.string' => 'A brand must be a string',
            'model.string' => 'A model must be a string',
            'price.integer' => 'A price must be an integer or null',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}


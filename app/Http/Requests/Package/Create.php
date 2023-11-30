<?php

namespace App\Http\Requests\Package;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'feature_id' => 'array|required',
            'name' => [
                'required',
                Rule::unique('packages', 'name')
            ],
            'price' => 'required',
            'is_best_seller' => 'required',
            'description' => 'required',
            'subscribe_period' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(formRequestResponseHelper($validator));
    }
}

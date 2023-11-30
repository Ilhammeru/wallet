<?php

namespace App\Http\Requests\Auth;

use App\Rules\ValidatePackage;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class Register extends FormRequest
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
            'username' => [
                'required',
                Rule::unique('users', 'username'),
            ],
            'password' => 'required|min:8|max:20',
            'package_id' => [
                'nullable',
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email'),
            ],
            'address' => 'nullable',
            'phone' => 'required',
            'phone_code' => 'required',
            'avatar' => 'nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(formRequestResponseHelper($validator));
    }
}

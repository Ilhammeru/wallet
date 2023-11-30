<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateWallet extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required',
            'wallet_category_id' => 'required|string',
            'is_lock' => 'nullable|boolean',
            'is_autosave' => 'nullable|boolean',
            'is_term_deposit' => 'nullable|boolean',
            'autosave_amount' => 'required_if:is_autosave,1',
            'autosave_type' => 'required_if:is_autosave,1',
            'autosave_source' => 'required_if:is_autosave,1',
            'term_deposit_duration' => 'required_if:is_term_deposit,1',
            'term_deposit_amount' => 'required_if:is_term_deposit,1',
            'term_deposit_source' => 'required_if:is_term_deposit,1',
            'lock_duration' => 'required_if:is_lock,1|required_if:is_lock,true',
            'lock_target' => 'required_if:is_lock,1|required_if:is_lock,true',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(formRequestResponseHelper($validator));
    }
}

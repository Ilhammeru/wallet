<?php

namespace App\Http\Requests\WalletCategory;

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
            'name' => [
                'required',
                Rule::unique('wallet_categories', 'name'),
            ],
            'description' => 'required',
            'is_autosave' => 'required|boolean',
            'is_term_deposit' => 'required|boolean',
            'is_lock' => 'required|boolean',
            // 'autosave_amount' => 'required_if:is_autosave,1',
            // 'autosave_type' => 'required_if:is_autosave,1',
            // 'autosave_source' => 'required_if:is_autosave,1',
            // 'term_deposit_duration' => 'required_if:is_term_deposit,1',
            // 'term_deposit_amount' => 'required_if:is_term_deposit,1',
            // 'term_deposit_source' => 'required_if:is_term_deposit,1',
            // 'lock_duration' => 'required_if:is_lock,1',
            // 'lock_target' => 'required_if:is_lock,1',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(formRequestResponseHelper($validator));
    }
}

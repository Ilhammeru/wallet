<?php

namespace App\Rules;

use App\Models\Package;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidatePackage implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty($value) && $value != "") {
            $id = decodeID($value);

            $check = Package::select('id')->find($id);
            if (!$check) {
                $fail(__('auth.package_not_found'));
            }
        }
    }
}

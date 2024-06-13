<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class FromDateBeforeToDate implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $fromDate = request()->input('from_date');
       
        // Check if the from_date is before or equal to the to_date
        return strtotime($value) < strtotime($fromDate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The To Date must be greater to the From Date.';
    }
}

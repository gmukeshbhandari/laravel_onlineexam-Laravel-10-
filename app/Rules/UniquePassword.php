<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UniquePassword implements ValidationRule
{

    protected $guard;
    public function __construct(string $guard)
    {
        $this->guard = $guard;
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Retrieve the current user's password from the database
        $currentPassword = Auth::guard($this->guard)->user()->password;
        $previousPassword = Auth::guard($this->guard)->user()->Previous_Password;

        if ($previousPassword == '')
        {
            if(Hash::check($value, $currentPassword))
            {
                $fail('The new password cannot be the same as the present passwords and previous passwords.');
            }
        }
        if ($previousPassword != '')
        {
            if(Hash::check($value, $currentPassword) || Hash::check($value, $previousPassword))
            {
                $fail('The new password cannot be the same as the present and previous passwords.');
            }
         } 
    }
}

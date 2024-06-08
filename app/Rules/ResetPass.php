<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Users;


class ResetPass implements ValidationRule
{

    protected $email;
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Retrieve the current user's password from the database
        $emailexistinadmin = Admin::where('email',$this->email)->first();
        $emailexistinusers = Users::where('email',$this->email)->first();

        if(!$emailexistinadmin && !$emailexistinusers)
        {
            $fail('Email does not exist.');
        }

        if ($emailexistinadmin)
        {
            $currentPassword = $emailexistinadmin->password;
            $previousPassword = $emailexistinadmin->Previous_Password;
        }
        
        if ($emailexistinusers)
        {
            $currentPassword = $emailexistinusers->password;
            $previousPassword = $emailexistinusers->Previous_Password;
        }

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

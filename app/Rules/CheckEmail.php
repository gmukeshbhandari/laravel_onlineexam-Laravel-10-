<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Users;

class CheckEmail implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emailcheckinuser = Users::where('email',$value)->exists();
        $emailcheckinadmin = Admin::where('email',$value)->exists();
        if ($emailcheckinuser || $emailcheckinadmin)
        {
            if($emailcheckinuser)
            {
                $datauser = Users::where('email',$value)->first();
                if($datauser->flag_en_dis == 0)
                {
                    $fail('This email is disabled.');
                }
                if($datauser->Verified == 0)
                {
                    $fail('Email not Verified.');
                }
                if($datauser->Account_Deleted == "Deleted")
                {
                    $fail('Email does not exist.');
                }
                if(Auth::guard('customuser')->check())
                {
                    $loginemail = Auth::guard('customuser')->user()->email;
                    if ($loginemail == $value)
                    {
                        $fail('Oops! You are currently logged in, and we can not send a reset email while you are logged in. Please log out first before attempting to reset your password.');
                    }
                }
            }
            if($emailcheckinadmin)
            {
                $dataadmin = Admin::where('email',$value)->first();
                if($dataadmin->flag_en_dis == 0)
                {
                    $fail('This email is disabled.');
                }
                if($dataadmin->Verified == 0)
                {
                    $fail('Email not Verified.');
                }
                if($dataadmin->Account_Deleted == "Deleted")
                {
                    $fail('Email does not exist.');
                }
                if(Auth::guard('admin')->check())
                {
                    $loginemail = Auth::guard('admin')->user()->email;
                    if ($loginemail == $value)
                    {
                        $fail('Oops! You are currently logged in, and we can not send a reset email while you are logged in. Please log out first before attempting to reset your password.');
                    }
                }
            }
               
        }
    }
}

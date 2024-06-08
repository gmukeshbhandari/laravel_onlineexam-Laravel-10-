<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;
use App\Rules\UniquePassword;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
{

   
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $currentGuard = $this->input('guard');
        // if(Auth::guard('customuser')->check() || Auth::guard('admin')->check())
        if ($currentGuard === 'admin' || $currentGuard === 'customuser')
         {
            return true;
         }
        else
        {
            return false;
        }
       
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentGuard = $this->input('guard');
       
        return [
            'oldpassword' => ['required',new CurrentPassword($currentGuard)],
            'password' => ['required','min:8','max:72','same:confirmpassword',new UniquePassword($currentGuard)],
            'confirmpassword' => ['required','max:72'],
        ];
    }

    /**
 * Get custom attributes for validator errors.
 *
 * @return array<string, string>
 */
    public function attributes(): array
    {
        return [
            'oldpassword' => 'old password',
            'password' => 'new password',
            'confirmpassword' => 'confirm password',
        ];
    }
    public function messages()
    {
        return [
            'oldpassword.required' => 'The :attribute is required.',
            'password.required' => 'The :attribute is required.',
            'password.min' => 'The :attribute must be at least :min characters.',
            'password.max' => 'The :attribute may not be greater than :max characters.',
            'password.same' => 'The :attribute and confirmation must match.',
            'confirmpassword.required' => 'The :attribute field is required.',
        ];
    }
}

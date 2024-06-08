<?php

namespace App\Http\Requests;

use App\Rules\ResetPass;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
       $email = $this->input('email');
        return [
            'password' => ['required','min:8','max:72','same:confirmpassword', new ResetPass($email)],
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
        'password' => 'new password',
        'confirmpassword' => 'confirm password',
    ];
}
public function messages()
{
    return [
        'password.required' => 'The :attribute is required.',
        'password.min' => 'The :attribute must be at least :min characters.',
        'password.max' => 'The :attribute may not be greater than :max characters.',
        'password.same' => 'The :attribute and confirmation must match.',
        'confirmpassword.required' => 'The :attribute field is required.',
    ];
}
}

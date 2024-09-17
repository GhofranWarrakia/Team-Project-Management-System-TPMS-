<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow all users to make this request.
        // Update this method based on your authorization logic.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' is required, must be a string, and can have a maximum length of 255 characters.
            'name' => 'required|string|max:255',

            // 'email' is required, must be a valid email format,
            // and must be unique in the 'users' table except for the current user being updated.
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user,

            // 'password' is optional; if provided, it must be a string with a minimum length of 8 characters.
            'password' => 'sometimes|required|string|min:8',
        ];
    }

    /**
     * Get the custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Custom error message for 'name' field when it is not provided.
            'name.required' => 'الاسم مطلوب.',

            // Custom error message for 'email' field when it is not provided.
            'email.required' => 'البريد الإلكتروني مطلوب.',

            // Custom error message for 'email' field when the email is already taken.
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقًا.',

            // Custom error message for 'password' field when it is not provided.
            'password.required' => 'كلمة المرور مطلوبة.',
        ];
    }
}

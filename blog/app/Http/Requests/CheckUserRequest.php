<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'email' => 'required | email ',
            'password' => 'required | min:6',
        ];
    }
    public function messages(): array{
        return [
            //
            'email.email' => ':attribute không hợp lệ',
            'email.required' => ':attribute không được để trống',
            'password.required' => ':attribute không được để trống',
            'password.min' => ':attribute phải có ít nhất 6 kí tự',
        ];
    }
    public function attributes(): array{
        return [
            //
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }
}

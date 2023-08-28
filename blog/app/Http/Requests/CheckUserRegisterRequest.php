<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:50|regex:/[a-zA-Z0-9]/|unique:users,name',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | min:6',
            'repassword' => 'required | min:6 | same:password',
        ];
    }
    public function messages(): array{
        return [
            //
            'name.required' => ':attribute không được để trống',
            'name.min' => ':attribute phải có ít nhất 3 kí tự',
            'name.max' => ':attribute phải có ít nhất 50 kí tự',
            'name.unique' => ':attribute đã tồn tại',
            'name.regex' => ':attribute không hợp lệ',
            'email.email' => ':attribute không hợp lệ',
            'email.required' => ':attribute không được để trống',
            'email.unique' => ':attribute đã tồn tại',
            'password.required' => ':attribute không được để trống',
            'password.min' => ':attribute phải có ít nhất 6 kí tự',
            'repassword.required' => ':attribute không được để trống',
            'repassword.min' => ':attribute phải có ít nhất 6 kí tự',
            'repassword.same' => ':attribute không trùng khớp',
        ];
    }
    public function attributes(): array{
        return [
            //
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'repassword' => 'Mật khẩu',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckContactRequest extends FormRequest
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
            'name' => 'required | min:3 | max:50',
            'email' => 'required | email ',
            'subject' => 'required | min:3 |max:50',
            'message' => 'required | min:3'
        ];
    }
    public function messages(): array{
        return [
            //
            'name.required' => ':attribute không được để trống',
            'name.min' => ':attribute phải có ít nhất 3 kí tự',
            'name.max' => ':attribute phải có ít nhất 50 kí tự',
            'email.email' => ':attribute không hợp lệ',
            'email.required' => ':attribute không được để trống',
            'subject.required' => ':attribute không được để trống',
            'subject.min' => ':attribute phải có ít nhất 3 kí tự',
            'subject.max' => ':attribute phải có ít nhất 50 kí tự',
            'message.required' => ':attribute không được để trống',
            'message.min' => ':attribute phải có ít nhất 3 kí tự',
        ];
    }
    public function attributes(): array{
        return [
            //
            'name' => 'Tên',
            'email' => 'Email',
            'subject' => 'Tiêu đề',
            'message' => 'Nội dung',
        ];
    }
}

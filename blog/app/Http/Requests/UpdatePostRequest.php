<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required | max:255 |min :3 |',
            'content' => 'required | min :3',
            'user_id' => 'required |exists:users,id',
            'category_id' => 'required| exists:categories,id',
        ];
    }
    public function messages(): array{
        return [
            'image.image' => ':attribute không đúng định dạng',
            'image.mimes' => ':attribute không đúng định dạng',
            'image.max' => ':attribute không đúng định dạng',
            'title.required' => ':attribute không được để trống',
            'title.unique' => ':attribute đã tồn tại',
            'title.max' => ':attribute không được vượt quá 255 kí tự',
            'title.min' => ':attribute không được nhỏ hơn 3 kí tự',
            'content.required' => ':attribute không được để trống',
            'content.min' => ':attribute không được nhỏ hơn 10 kí tự',
            'user_id.required' => ':attribute không được để trống',
            'user_id.exists' => ':attribute không tồn tại',
            'category_id.required' => ':attribute không được để trống',
            'category_id.exists' => ':attribute không tồn tại',

        ];
    }
    public function attributes(): array{

        return [
            'image' => 'Ảnh',
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'user_id' => 'Tác giả',
            'category_id' => 'Danh mục',
        ];
    }
}

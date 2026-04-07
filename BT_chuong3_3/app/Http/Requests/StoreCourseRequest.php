<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bật thành true để cho phép request
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|gt:0', // gt:0 nghĩa là greater than 0 (lớn hơn 0)
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Bắt buộc là file ảnh
            'status' => 'required|in:draft,published'
        ];
    }

    // Tùy chọn: Bạn có thể custom messages báo lỗi ở đây
    public function messages()
    {
        return [
            'name.required' => 'Tên khóa học không được để trống.',
            'price.required' => 'Vui lòng nhập giá khóa học.',
            'price.gt' => 'Giá khóa học phải lớn hơn 0.',
        ];
    }
}

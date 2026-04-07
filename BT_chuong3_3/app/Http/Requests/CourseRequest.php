<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    // Bật true để cho phép mọi user gửi form này
    public function authorize(): bool
    {
        return true; 
    }

    // Các luật kiểm tra dữ liệu
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:published,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên khóa học.',
            'price.required' => 'Vui lòng nhập giá khóa học.',
            'price.numeric' => 'Giá phải là số.',
            'image.image' => 'File tải lên phải là hình ảnh.'
        ];
    }
}

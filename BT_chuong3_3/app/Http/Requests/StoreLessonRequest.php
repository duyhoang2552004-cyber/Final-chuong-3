<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Bắt buộc đổi thành true
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url', // Validate phải là định dạng URL (đường dẫn web)
            'order' => 'required|integer|min:0'
        ];
    }
}

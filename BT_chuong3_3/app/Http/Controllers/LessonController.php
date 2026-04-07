<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;

class LessonController extends Controller
{
    // 1. Danh sách bài học của 1 khóa cụ thể
    public function index(Course $course)
    {
        // Sử dụng relationship để lấy bài học, và orderBy để sắp xếp theo cột 'order' như đề yêu cầu
        $lessons = $course->lessons()->orderBy('order', 'asc')->get();
        return view('lessons.index', compact('course', 'lessons'));
    }

    // 2. Form thêm bài học
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    // 3. Xử lý lưu bài học
    public function store(StoreLessonRequest $request, Course $course)
    {
        // Vì đã thiết lập quan hệ 1-N trong Model, ta dùng $course->lessons()->create()
        // Laravel sẽ tự động điền đúng course_id cho bài học này
        $course->lessons()->create($request->validated());
        
        return redirect()->route('courses.lessons.index', $course->id)->with('success', 'Đã thêm bài học!');
    }

    // 4. Form cập nhật
    public function edit(Course $course, Lesson $lesson)
    {
        return view('lessons.edit', compact('course', 'lesson'));
    }

    // 5. Xử lý cập nhật
    public function update(UpdateLessonRequest $request, Course $course, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return redirect()->route('courses.lessons.index', $course->id)->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa bài học (Soft Delete)
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->back()->with('success', 'Đã xóa bài học!');
    }
}
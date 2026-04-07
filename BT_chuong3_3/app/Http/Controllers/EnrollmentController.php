<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

// CHỈ ĐƯỢC CÓ 1 DÒNG NÀY Ở ĐẦU FILE (Sau các dòng use)
class EnrollmentController extends Controller
{
    // 1. Hiển thị Form đăng ký
    public function create()
    {
        $courses = Course::all();
        return view('enrollments.create', compact('courses'));
    }

    // 2. Xử lý lưu đăng ký
   public function store(Request $request)
{
    try {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // Tạo hoặc lấy học viên cũ dựa trên email
        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        // Đính kèm vào khóa học
        $student->courses()->syncWithoutDetaching([$request->course_id]);

        return redirect()->route('courses.index')->with('success', 'Đăng ký thành công!');
        
    } catch (\Exception $e) {
        // Nếu lỗi, quay lại và hiện thông báo thay vì trắng trang
        return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}

    // 3. Hiển thị danh sách học viên theo từng khóa
   public function index(Course $course)
{
    // Lấy danh sách học viên thông qua quan hệ students() đã thiết lập ở Model
    $students = $course->students()->get(); 
    $totalStudents = $students->count();

    return view('enrollments.index', compact('course', 'students', 'totalStudents'));
}
    
} // Dấu đóng ngoặc này là kết thúc file, không được có thêm class nào ở dưới nữa
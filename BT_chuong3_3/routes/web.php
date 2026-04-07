<?php

use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. CÁC ROUTE ĐẶC BIỆT CỦA COURSE (Phải đặt TRÊN Resource)
// Xem thùng rác
Route::get('courses/trash', [CourseController::class, 'trash'])->name('courses.trash');
// Khôi phục khóa học
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
// Route xóa vĩnh viễn (Phải dùng phương thức DELETE)
Route::delete('courses/{id}/force-delete', [CourseController::class, 'forceDelete'])->name('courses.forceDelete');


// 2. RESOURCE ROUTES (Quản lý CRUD mặc định)
// Khóa học
Route::resource('courses', CourseController::class);

// Bài học (Nested Resource - Bài học lồng trong Khóa học)
Route::resource('courses.lessons', LessonController::class);


// 3. ROUTE MẶC ĐỊNH (Trang chủ)
Route::get('/', function () {
    return redirect()->route('courses.index');
});

// Route cho Form đăng ký chung
Route::get('enroll/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('enroll/store', [EnrollmentController::class, 'store'])->name('enrollments.store');

// Route xem danh sách học viên theo từng khóa (giống như xem bài học)
Route::get('courses/{course}/students', [EnrollmentController::class, 'index'])->name('courses.students.index');

// Route cho Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Sửa lại Route mặc định (khi vừa vào web sẽ trỏ thẳng tới trang Dashboard)
Route::get('/', function () {
    return redirect()->route('dashboard');
});
<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query và giải quyết N+1 Query (Yêu cầu 3.4)
        $query = Course::with(['lessons'])->withCount(['lessons', 'students']);

        // --- 3.1. TÌM KIẾM NÂNG CAO ---
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status == 'published') {
                $query->published();
            } else {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->priceBetween($request->min_price, $request->max_price);
        } elseif ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        } elseif ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // --- 3.2. LỌC & SẮP XẾP ---
        $sortBy = $request->sort_by ?? 'created_at';
        $sortDir = $request->sort_dir ?? 'desc';

        if ($sortBy == 'students') {
            $query->orderBy('students_count', $sortDir);
        } else {
            $query->orderBy($sortBy, $sortDir);
        }

        $courses = $query->paginate(10)->withQueryString();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->price = $request->price;
        $course->status = $request->status;
        $course->description = $request->description;

        if ($request->hasFile('image')) {
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($request->remove_image == '1') {
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = null;
        }

        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->name = $request->name;
        $course->price = $request->price;
        $course->status = $request->status;
        $course->description = $request->description;
        
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Cập nhật khóa học thành công!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete(); 
        return redirect()->route('courses.index')->with('success', 'Đã chuyển khóa học vào thùng rác!');
    }

    // --- CÁC HÀM XỬ LÝ THÙNG RÁC Ở ĐÂY NÈ ---
    public function trash()
    {
        $courses = Course::onlyTrashed()->latest()->paginate(10);
        return view('courses.trash', compact('courses'));
    }

    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route('courses.trash')->with('success', 'Khôi phục khóa học thành công!');
    }

    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }
        $course->forceDelete();
        return redirect()->route('courses.trash')->with('success', 'Đã xóa vĩnh viễn khóa học!');
    }
}
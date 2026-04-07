<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();

        $courses = Course::withCount('students')->get();
        $totalRevenue = 0;
        foreach ($courses as $course) {
            $totalRevenue += ($course->price * $course->students_count);
        }

        $topCourse = Course::withCount('students')->orderByDesc('students_count')->first();
        $latestCourses = Course::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalCourses', 
            'totalStudents', 
            'totalRevenue', 
            'topCourse', 
            'latestCourses'
        ));
    }
}
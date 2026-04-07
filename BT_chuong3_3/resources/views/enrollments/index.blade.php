@extends('layouts.master')

@section('content')
<div class="mb-3">
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
        &laquo; Quay lại danh sách khóa học
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Học viên khóa: {{ $course->name }}</h4>
        <span class="badge bg-light text-dark fs-6">Tổng số: {{ $totalStudents }} học viên</span>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên học viên</th>
                    <th>Email</th>
                    <th>Ngày đăng ký</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td class="fw-bold">{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->pivot->created_at ? $student->pivot->created_at->format('d/m/Y') : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Chưa có học viên nào đăng ký khóa học này.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-person-plus-fill text-primary"></i> Đăng ký Khóa học</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Quay lại danh sách
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn khóa học:</label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                            <option value="">-- Vui lòng chọn khóa học --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên học viên:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Nhập họ và tên học viên" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               placeholder="vi-du@email.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle"></i> Xác nhận đăng ký học
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
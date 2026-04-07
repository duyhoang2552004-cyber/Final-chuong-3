@extends('layouts.master')

@section('content')
<div class="mb-3">
    <a href="{{ route('courses.lessons.index', $course->id) }}" class="btn btn-outline-secondary btn-sm">
        &laquo; Quay lại danh sách bài học
    </a>
</div>

<h2>Thêm Bài học cho khóa: <span class="text-primary">{{ $course->name }}</span></h2>

<form action="{{ route('courses.lessons.store', $course->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Tiêu đề bài học:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Thứ tự hiển thị (Order):</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
        @error('order') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Video URL (Đường dẫn video):</label>
        <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/...">
        @error('video_url') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Nội dung chi tiết:</label>
        <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-success">Lưu bài học</button>
</form>
@endsection
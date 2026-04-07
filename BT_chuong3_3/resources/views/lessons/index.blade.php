@extends('layouts.master')

@section('content')
<div class="mb-3">
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
        &laquo; Quay lại danh sách khóa học
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Bài học: <span class="text-primary">{{ $course->name }}</span></h2>
    <a href="{{ route('courses.lessons.create', $course->id) }}" class="btn btn-primary">
        + Thêm bài học mới
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th style="width: 80px;">Thứ tự</th>
            <th>Tiêu đề bài học</th>
            <th>Video URL</th>
            <th style="width: 150px;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($lessons as $lesson)
        <tr>
            <td class="text-center fw-bold">{{ $lesson->order }}</td>
            <td>{{ $lesson->title }}</td>
            <td>
    @if($lesson->video_url)
        <a href="{{ $lesson->video_url }}" target="_blank" class="text-decoration-none">
            🔗 Xem Video
        </a>
    @else
        <span class="text-muted">Không có link</span>
    @endif
</td>
            <td>
                <a href="{{ route('courses.lessons.edit', [$course->id, $lesson->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('courses.lessons.destroy', [$course->id, $lesson->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bài học này?');">
                    @csrf
                    @method('DELETE')
                   <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $course->id }}')">
        Xóa
    </button>
</form>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">Chưa có bài học nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
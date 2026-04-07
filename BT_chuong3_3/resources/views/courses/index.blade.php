@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-list-ul"></i> Danh sách Khóa học</h2>
    <div>
        <a href="{{ route('courses.trash') }}" class="btn btn-outline-danger me-2">
            <i class="bi bi-trash"></i> Thùng rác
        </a>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm khóa học mới
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3 text-center" style="width: 70px;">STT</th>
                    <th>Ảnh</th>
                    <th>Tên khóa học</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Số bài học</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    {{-- Cột STT tự động cập nhật dựa trên trang hiện tại --}}
                    <td class="ps-3 text-center fw-bold text-secondary">
                        {{ ($courses->currentPage() - 1) * $courses->perPage() + $loop->iteration }}
                    </td>
                    
                    <td>
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" class="rounded shadow-sm" width="80" height="50" style="object-fit: cover;">
                        @else
                            <span class="badge bg-light text-muted border">No Image</span>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $course->name }}</td>
                    <td class="text-danger fw-bold">{{ number_format($course->price) }} đ</td>
                    <td>
                        @include('components.status-badge', ['status' => $course->status])
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $course->lessons_count }} bài</span></td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm">
                            <a href="{{ route('courses.lessons.index', $course->id) }}" class="btn btn-sm btn-outline-primary" title="Quản lý bài học">
                                <i class="bi bi-journal-text"></i>
                            </a>
                            <a href="{{ route('courses.students.index', $course->id) }}" class="btn btn-sm btn-outline-success" title="Danh sách học viên">
                                <i class="bi bi-people"></i>
                            </a>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(this)" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $courses->links('pagination::bootstrap-5') }}
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-trash3-fill text-danger"></i> Thùng rác Khóa học</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary shadow-sm">
        <i class="bi bi-arrow-left"></i> Quay lại danh sách
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 60px;">STT</th>
                        <th class="text-center" style="width: 120px;">Ảnh</th>
                        <th>Tên khóa học</th>
                        <th>Ngày xóa</th>
                        <th class="text-center" style="width: 220px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="text-center fw-bold text-secondary">
                            {{ ($courses->currentPage() - 1) * $courses->perPage() + $loop->iteration }}
                        </td>
                        
                        <td class="text-center">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="rounded shadow-sm" width="80" height="50" style="object-fit: cover;">
                            @else
                                <span class="badge bg-light text-muted border px-2 py-1">Không ảnh</span>
                            @endif
                        </td>
                        
                        <td class="fw-bold text-dark fs-6">{{ $course->name }}</td>
                        
                        <td>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">
                                <i class="bi bi-clock-history"></i> {{ $course->deleted_at->format('d/m/Y H:i') }}
                            </span>
                        </td>
                        
                        <td class="text-center">
                            <form action="{{ route('courses.restore', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success shadow-sm" title="Khôi phục">
                                    <i class="bi bi-arrow-counterclockwise"></i> Khôi phục
                                </button>
                            </form>

                            <form action="{{ route('courses.forceDelete', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger shadow-sm ms-1" onclick="confirmDelete(this)" title="Xóa vĩnh viễn">
                                    <i class="bi bi-trash"></i> Xóa luôn
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3 text-secondary opacity-50"></i>
                            <h5 class="fw-light">Thùng rác hiện đang trống.</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $courses->links('pagination::bootstrap-5') }}
</div>
@endsection
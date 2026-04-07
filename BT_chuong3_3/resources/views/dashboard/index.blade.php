@extends('layouts.master')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold"><i class="bi bi-speedometer2 text-primary"></i> Tổng quan Hệ thống</h2>
    <p class="text-muted">Thống kê dữ liệu quản lý khóa học của bạn</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2">Tổng khóa học</h6>
                    <h2 class="fw-bold mb-0">{{ $totalCourses }}</h2>
                </div>
                <i class="bi bi-journal-bookmark fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2">Tổng học viên</h6>
                    <h2 class="fw-bold mb-0">{{ $totalStudents }}</h2>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-warning text-dark h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2">Tổng doanh thu</h6>
                    <h3 class="fw-bold mb-0">{{ number_format($totalRevenue) }} đ</h3>
                </div>
                <i class="bi bi-cash-coin fs-1 opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-danger text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2">Khóa HOT nhất</h6>
                    <h5 class="fw-bold mb-1 text-truncate" style="max-width: 150px;" title="{{ $topCourse ? $topCourse->name : 'Chưa có' }}">
                        {{ $topCourse ? $topCourse->name : 'Chưa có' }}
                    </h5>
                    <small>{{ $topCourse ? $topCourse->students_count . ' học viên' : '' }}</small>
                </div>
                <i class="bi bi-fire fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-stars text-warning"></i> 5 Khóa học mới cập nhật</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Tên khóa học</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestCourses as $course)
                <tr>
                    <td class="ps-4 fw-bold">{{ $course->name }}</td>
                    <td class="text-danger fw-semibold">{{ number_format($course->price) }} đ</td>
                    <td>@include('components.status-badge', ['status' => $course->status])</td>
                    <td>{{ $course->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Chưa có khóa học nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
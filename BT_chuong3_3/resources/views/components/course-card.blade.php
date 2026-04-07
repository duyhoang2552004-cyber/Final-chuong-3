<div class="card h-100 shadow-sm border-0">
    <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/300x200' }}" 
         class="card-img-top" alt="{{ $course->name }}" style="height: 200px; object-fit: cover;">
    <div class="card-body">
        <h5 class="card-title fw-bold text-truncate">{{ $course->name }}</h5>
        <p class="text-danger fw-bold">{{ number_format($course->price) }} VNĐ</p>
        
        <x-status-badge :status="$course->status" />
    </div>
    <div class="card-footer bg-white border-0 d-flex justify-content-between">
        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-warning btn-sm">Sửa</a>
        <a href="{{ route('courses.lessons.index', $course->id) }}" class="btn btn-primary btn-sm">Bài học</a>
    </div>
</div>
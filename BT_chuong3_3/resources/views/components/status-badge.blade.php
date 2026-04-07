@if($status == 'published')
    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3">
        <i class="bi bi-check-circle-fill me-1"></i> Đã xuất bản
    </span>
@else
    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3">
        <i class="bi bi-file-earmark-lock-fill me-1"></i> Bản nháp
    </span>
@endif
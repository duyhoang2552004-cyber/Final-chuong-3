@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-plus-circle-fill text-primary"></i> Thêm Khóa học mới</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Quay lại danh sách
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Tên khóa học:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nhập tên khóa học..." required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Giá (VNĐ):</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Ví dụ: 20000000" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trạng thái:</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản (Published)</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp (Draft)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Ảnh đại diện:</label>
                <div class="input-group">
                    <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                    <button class="btn btn-outline-danger" type="button" onclick="clearImage()">
                        <i class="bi bi-x-lg"></i> Xóa file
                    </button>
                </div>
                @error('image') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror

                <div id="imagePreviewContainer" class="mt-3 d-none">
                    <p class="text-muted mb-1 small"><i class="bi bi-image"></i> Ảnh xem trước:</p>
                    <img id="imagePreview" src="" alt="Preview" class="img-thumbnail shadow-sm" style="max-height: 150px; object-fit: cover;">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Mô tả chi tiết:</label>
                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Nhập mô tả khóa học...">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> Lưu khóa học</button>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewContainer').classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function clearImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').src = '';
        document.getElementById('imagePreviewContainer').classList.add('d-none');
    }
</script>
@endsection
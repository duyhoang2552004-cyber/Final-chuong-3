<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Khóa Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; }
        #sidebarMenu {
            min-height: 100vh;
            background: #212529;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        #sidebarMenu .nav-link {
            color: #adb5bd;
            padding: 15px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        #sidebarMenu .nav-link:hover, #sidebarMenu .nav-link.active {
            color: #fff;
            background: #343a40;
            border-left: 4px solid #0d6efd;
        }
        #sidebarMenu .nav-link i { margin-right: 10px; }
        .main-content { padding: 30px; }
        .content-wrapper {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <h5 class="text-white px-3 mb-4 fw-bold text-center"> QUẢN TRỊ VIÊN</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Tổng quan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('courses*') && !request()->is('courses/trash') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            <i class="bi bi-grid-fill"></i> Quản lý Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('enroll*') ? 'active' : '' }}" href="{{ route('enrollments.create') }}">
                            <i class="bi bi-person-plus-fill"></i> Đăng ký học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('courses/trash') ? 'active' : '' }}" href="{{ route('courses.trash') }}">
                            <i class="bi bi-trash3-fill"></i> Thùng rác
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            @include('components.alert')

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Hành động này có thể thay đổi dữ liệu của bạn!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Đồng ý thực hiện!',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        })
    }
</script>
</body>
</html>
## Các tính năng chính
- **Dashboard:** Thống kê trực quan số lượng khóa học, học viên và doanh thu.
- **Quản lý CRUD:** Thêm, sửa, xóa (Soft Delete) và khôi phục khóa học từ thùng rác.
- **Tìm kiếm & Lọc:** Bộ lọc nâng cao theo tên, giá, trạng thái và sắp xếp động.
- **Xử lý ảnh:** Upload ảnh đại diện với tính năng xem trước (Preview) và xóa ảnh cũ.
- **Tối ưu hóa:** Khắc phục lỗi N+1 Query bằng Eager Loading.

## Hướng dẫn cài đặt nhanh (Localhost)

1. **Clone mã nguồn về máy:**
   `git clone <link-github-cua-duy>`
2. **Cài đặt thư viện:**
   `composer install`
3. **Cấu hình file .env:**
   `cp .env.example .env` 
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=ten_database_cua_ban
      DB_USERNAME=root
      DB_PASSWORD=
4. **Tạo Key & Database:**
   `php artisan key:generate`
   `php artisan migrate`
5. **Cấp quyền hiển thị ảnh:**
   `php artisan storage:link`
6. **Chạy server:**
   `php artisan serve`

Truy cập: `http://127.0.0.1:8000`

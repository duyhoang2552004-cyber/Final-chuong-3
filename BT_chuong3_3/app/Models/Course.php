<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes; // Khai báo dùng Soft Delete

    protected $fillable = ['name', 'slug', 'price', 'description', 'image', 'status'];

    // 1 Course -> nhiều Lesson
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Quan hệ Many-to-Many với Student thông qua bảng enrollments
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
    // Scope lọc khóa học đã xuất bản (Published)
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope lọc theo khoảng giá
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
}

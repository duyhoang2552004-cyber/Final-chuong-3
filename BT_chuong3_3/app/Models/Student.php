<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Cho phép lưu các trường này
    protected $fillable = ['name', 'email'];

    // Thiết lập quan hệ Nhiều - Nhiều với Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['course_id', 'title', 'content', 'video_url', 'order'];

    // Thuộc về 1 Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

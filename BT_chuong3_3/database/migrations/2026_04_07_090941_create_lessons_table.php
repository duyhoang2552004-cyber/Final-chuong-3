<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // Liên kết với bảng courses
        $table->string('title');
        $table->text('content')->nullable();
        $table->string('video_url')->nullable();
        $table->integer('order')->default(0); // Thứ tự
        $table->timestamps();
        $table->softDeletes(); // Cứ thêm soft delete cho an toàn
    });
}
};

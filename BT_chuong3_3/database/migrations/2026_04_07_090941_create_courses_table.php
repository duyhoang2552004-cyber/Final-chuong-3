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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique(); // Tự sinh
        $table->integer('price'); // Giá > 0 (sẽ check ở validation)
        $table->text('description')->nullable();
        $table->string('image')->nullable(); // Lưu đường dẫn ảnh
        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->timestamps();
        $table->softDeletes(); // Bắt buộc theo yêu cầu Xóa khóa học
    });
}
};

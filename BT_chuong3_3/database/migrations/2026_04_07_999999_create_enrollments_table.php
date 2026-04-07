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
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        $table->timestamps();
    });
}
};

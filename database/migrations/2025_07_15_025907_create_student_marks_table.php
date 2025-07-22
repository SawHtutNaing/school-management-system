<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('student_marks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('student_id');
    $table->unsignedBigInteger('subject_id');
    $table->unsignedBigInteger('class_id');
    $table->integer('marks')->nullable(); // Can be null if not yet graded
    $table->string('grade')->nullable();  // Letter grade (A, B, C, etc.)
    $table->decimal('grade_point', 3, 2)->nullable(); // Numeric grade point (4.0, 3.5, etc.)
    $table->timestamps();

    // Foreign keys
    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
    $table->foreign('class_id')->references('id')->on('class_models')->onDelete('cascade');

    // Ensure unique combination of student, subject, and class
    $table->unique(['student_id', 'subject_id', 'class_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};

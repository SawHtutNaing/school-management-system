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
      Schema::create('student_gpas', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('student_id');
    $table->unsignedBigInteger('class_id');
    $table->decimal('gpa', 3, 2); // Overall GPA for the class/semester
    $table->integer('total_credits');
    $table->integer('earned_credits');
    $table->timestamps();

    // Foreign keys
    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    $table->foreign('class_id')->references('id')->on('class_models')->onDelete('cascade');

    // Ensure unique combination of student and class
    $table->unique(['student_id', 'class_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_gpas');
    }
};

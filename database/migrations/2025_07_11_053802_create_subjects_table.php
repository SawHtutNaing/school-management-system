<?php

// database/migrations/xxxx_xx_xx_create_subjects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('subject_code_id');
            $table->string('code')->unique();            // e.g. MTH101
            $table->unsignedBigInteger('teacher_id')->nullable(); // optional: who teaches this
            $table->unsignedBigInteger('class_id');    // which class this subject belongs to
            $table->text('description')->nullable();     // optional details
            $table->timestamps();

            // Foreign keys
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->foreign('class_id')->references('id')->on('class_models')->onDelete('cascade');
            $table->foreign('subject_code_id')->references('id')->on('subject_codes')->onDelete('cascade');
        });


    }

    public function down()
    {
        Schema::dropIfExists('subjects');

    }
}
;

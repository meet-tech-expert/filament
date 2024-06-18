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
        Schema::create('m_student_academics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_id');
            $table->foreign('academic_id')->references('id')->on('m_academic_years');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('m_students');
            $table->unsignedBigInteger('added_by');  
            $table->unsignedBigInteger('updated_by'); 
            $table->timestamps();
        });
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_student_academics');
    }
};

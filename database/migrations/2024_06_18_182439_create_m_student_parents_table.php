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
        Schema::create('m_student_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stu_id');
            $table->string('father_name', 200);
            $table->string('mother_name', 200);
            $table->bigInteger('f_mobile')->nullable();
            $table->bigInteger('m_mobile')->nullable();
            $table->string('f_aadhaar', 15)->unique()->nullable();
            $table->string('m_aadhaar', 15)->unique()->nullable();
            $table->string('f_education', 100)->nullable();
            $table->string('m_education', 100)->nullable();
            $table->string('f_occupation', 100)->nullable();
            $table->string('m_occupation', 100)->nullable();
            $table->string('f_income', 50)->nullable();
            $table->string('m_income', 50)->nullable();
            $table->string('f_designation', 100)->nullable();
            $table->string('m_designation', 100)->nullable();
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('stu_id')->references('id')->on('m_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_student_parents');
    }
};

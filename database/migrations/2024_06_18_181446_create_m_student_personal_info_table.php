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
        Schema::create('m_student_personal_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stu_id');
            $table->string('nationality', 50);
            $table->tinyInteger('religion');
            $table->string('mother_tongue', 50);
            $table->tinyInteger('caste');
            $table->string('subcaste', 25)->nullable();
            $table->boolean('spectacle')->default(0);
            $table->longText('medical_history')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->longText('alergic_to')->nullable();
            $table->tinyInteger('food_choice')->default(1);
            $table->boolean('eye_contact')->default(1);
            $table->string('birth_place', 200);
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
        Schema::dropIfExists('m_student_personal_info');
    }
};

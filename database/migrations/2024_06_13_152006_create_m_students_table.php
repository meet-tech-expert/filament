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
        Schema::create('m_students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 200);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 200);
            $table->string('image', 200)->nullable();
            $table->unsignedBigInteger('academic_id')->nullable()->comment('Academic');
            $table->tinyInteger('gender')->default(1);
            $table->string('enroll_no', 200)->unique();
            $table->bigInteger('roll_no'); 
            $table->tinyInteger('admission_type')->default(1);
            $table->tinyInteger('medium')->default(1);
            $table->unsignedBigInteger('class_id')->comment('class');
            $table->unsignedBigInteger('branch_id')->comment('Branch');
            $table->unsignedBigInteger('sec_id')->comment('Section');
            $table->string('email', 200)->unique();
            $table->date('dob');
            $table->date('date_admission'); 
            $table->string('aadhaar', 12); 
            $table->tinyInteger('blood_group')->default(1);
            $table->text('remarks')->nullable();
            $table->string('hobbies', 200)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        
            // Foreign key constraints
            $table->foreign('class_id')->references('id')->on('m_classes');
            $table->foreign('branch_id')->references('id')->on('m_branches');
            $table->foreign('sec_id')->references('id')->on('m_sections');
            $table->foreign('academic_id')->references('id')->on('academic_years');
            $table->foreign('added_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_students');
    }
};

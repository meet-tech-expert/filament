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
            $table->unsignedBigInteger('academic_id')->comment('Academic');
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 2: Female,99: TransGender');
            $table->string('enroll_no', 200)->unique()->comment('stu_{yymm}{id}');
            $table->bigInteger('roll_no')->nullable();
            $table->tinyInteger('admission_type')->default(1)->comment('1: New, 2: old');
            $table->tinyInteger('medium')->default(1)->comment('1: English, 2: Hindi');
            $table->unsignedBigInteger('class_id')->comment('class');
            $table->unsignedBigInteger('branch_id')->comment('Branch');
            $table->unsignedBigInteger('sec_id')->comment('Section');
            $table->string('email', 200)->nullable();
            $table->date('dob');
            $table->date('date_admission'); 
            $table->string('aadhaar', 14)->nullable(); 
            $table->tinyInteger('blood_group')->default(1)->comment('1: A Negative, 2: A Positive, 3: B Negative, 4: B Positive, 5: AB Negative, 6: AB Positive, 7: O Negative, 8: O Positive, 99: OTHER');
            $table->text('remarks')->nullable();
            $table->string('hobbies', 200)->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: Inactive, 1: Active , 2: Discontinued, 3: Relieved');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        
            // Foreign key constraints
            $table->foreign('class_id')->references('id')->on('m_classes');
            $table->foreign('branch_id')->references('id')->on('m_branches');
            $table->foreign('sec_id')->references('id')->on('m_sections');
            $table->foreign('academic_id')->references('id')->on('m_academic_years');
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

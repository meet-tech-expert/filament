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
        Schema::create('m_discounts', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('academic_id');
            $table->integer('type');
            $table->tinyInteger('discount_for')->comment("1: Individual,2: Class");
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('discount_type')->comment('1: Percentage,2: Flat');
            $table->float('discount_value')->nullable();
            // $table->unsignedBigInteger('months'); 
            $table->text('remark')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('academic_id')
                  ->references('id')->on('m_academic_years')->onDelete('cascade');
            // $table->foreign('months')
                  // ->references('id')->on('m_months');      
            $table->foreign('class_id')
                  ->references('id')->on('m_classes')->onDelete('cascade'); 
            $table->foreign('student_id')
                  ->references('id')->on('m_students')->onDelete('cascade');       
            $table->foreign('added_by')
                  ->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('updated_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); 
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_discounts');
    }
};

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
        Schema::create('m_class_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id'); 
            $table->unsignedBigInteger('sub_id'); 
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('class_id')
                  ->references('id')->on('m_classes')
                  ->onDelete('cascade');
                   
            $table->foreign('sub_id')
                  ->references('id')->on('m_subjects')
                  ->onDelete('cascade');       

            $table->foreign('added_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('m_class_subjects');
    }
};

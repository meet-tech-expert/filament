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
        Schema::create('m_fees_structures', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('academic_id');
            $table->unsignedBigInteger('fees_id');
            $table->unsignedBigInteger('class_id');
            $table->float('fees')->default(0);
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('academic_id')
                  ->references('id')->on('m_academic_years')
                  ->onDelete('cascade'); 

            $table->foreign('fees_id')
                  ->references('id')->on('m_fees')
                  ->onDelete('cascade');

            $table->foreign('class_id')
                  ->references('id')->on('m_classes')
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
        Schema::dropIfExists('m_fees_structures');
    }
};

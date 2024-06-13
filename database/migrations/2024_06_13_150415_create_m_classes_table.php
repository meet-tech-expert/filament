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
        Schema::create('m_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_id')->comment('Academic');
            $table->string('class',20);
            $table->integer('class_code');
            $table->string('short_name',20);
            $table->tinyInteger('status')->default(1)->comment('1: Active ,0: Inactive');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        
            // Foreign key constraints
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
        Schema::dropIfExists('m_classes');
    }
};

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
        Schema::create('m_subjects', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('group')->default(1)->comment('1:Main ,2:Sub');
            $table->string('sub_name', 50)->nullable();
            $table->char('sub_code', 5)->nullable();
            $table->unsignedBigInteger('parent_subject')->nullable();
            $table->tinyInteger('order')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1: Active ,0: Inactive');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('parent_subject')->references('id')->on('m_subjects')->onDelete('set null');
            $table->foreign('added_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_subjects');
    }
};

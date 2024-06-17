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
        Schema::create('m_academic_years', function (Blueprint $table) {
            $table->id(); 
            $table->date('from_date');
            $table->date('to_date');
            $table->tinyInteger('status')->default(1)->comment('1: Active ,0: Inactive');
            $table->tinyInteger('set_primary')->default(0);
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        
            // Foreign key constraints
            $table->foreign('added_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_academic_years');
    }
};

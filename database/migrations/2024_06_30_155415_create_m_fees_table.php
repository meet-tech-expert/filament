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
        Schema::create('m_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_id');
            $table->string('type', 200);
            $table->string('description', 200)->nullable();
            $table->tinyInteger('is_due')->default(0);
            $table->float('due_fees')->nullable();
            $table->tinyInteger('due_date')->default(1); 
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('academic_id')
                  ->references('id')->on('m_academic_years')
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
        Schema::dropIfExists('fees');
    }
};

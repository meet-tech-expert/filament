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
        Schema::create('m_student_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stu_id')->constrained('m_students'); 
            $table->longText('cur_address')->nullable();
            $table->string('cur_city', 50)->nullable();
            $table->string('cur_state', 5)->nullable();
            $table->string('cur_zip', 6)->nullable();
            $table->tinyInteger('same_addr')->default(0); // 0 for unchecked, 1 for checked
            $table->longText('per_address')->nullable();
            $table->string('per_city', 50)->nullable();
            $table->string('per_state', 100)->nullable();
            $table->string('per_zip', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_student_addresses');
    }
};

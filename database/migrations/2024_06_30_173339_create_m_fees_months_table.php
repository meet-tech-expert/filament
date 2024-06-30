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
        Schema::create('m_fees_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fees_id');
            $table->tinyInteger('month_id');
            $table->timestamps();

            $table->foreign('fees_id')
                  ->references('id')->on('m_fees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_fees_months');
    }
};

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
        Schema::create('m_discount_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id'); 
            $table->foreign('discount_id')->references('id')->on('m_discounts');
            $table->unsignedBigInteger('month_id')->unsigned();
            $table->foreign('month_id')->references('id')->on('m_months');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_discount_months');
    }
};

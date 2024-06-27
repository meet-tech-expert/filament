<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('activity_log', 'm_activity_logs');
    }

    public function down()
    {
        Schema::rename('m_activity_logs', 'activity_log');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogsTable extends Migration
{
    public function up()
    {
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique();
            $table->string('request_method');
            $table->string('request_path');
            $table->text('request_data')->nullable();
            $table->text('response_content')->nullable();
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_logs');
    }
}

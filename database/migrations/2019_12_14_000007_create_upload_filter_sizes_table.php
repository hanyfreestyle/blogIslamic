<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('config_upload_filter_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_id')->unsigned();
            $table->integer('type')->default('1');
            $table->integer('new_w');
            $table->integer('new_h');
            $table->string('canvas_back')->nullable();

            $table->integer('get_more_option')->default('0');
            $table->integer('get_add_text')->default('0');
            $table->integer('get_watermark')->default('0');

            $table->foreign('filter_id')->references('id')->on('config_upload_filters')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_upload_filter_sizes');
    }
};

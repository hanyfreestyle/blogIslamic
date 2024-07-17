<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void
    {

        Schema::create('config_upload_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type')->default('1');
            $table->integer('convert_state')->default('1');
            $table->integer('quality_val')->default('85');
            $table->integer('new_w');
            $table->integer('new_h');
            $table->string('canvas_back')->default('#ffffff');
            $table->integer('greyscale')->default('0');
            $table->integer('flip_state')->default('0');
            $table->integer('flip_v')->default('0');
            $table->integer('blur')->default('0');
            $table->string('blur_size')->default('0');

            $table->integer('pixelate')->default('0');
            $table->string('pixelate_size')->default('5');
            $table->integer('text_state')->default('0');
            $table->string('text_print')->nullable();

            $table->string('font_size')->nullable();
            $table->string('font_path')->nullable();
            $table->string('font_color')->nullable();
            $table->string('font_opacity')->nullable();
            $table->string('text_position')->nullable();

            $table->integer('watermark_state')->default('0');
            $table->string('watermark_img')->nullable();
            $table->string('watermark_position')->nullable();

            $table->integer('state')->default('0');

            foreach (config('app.admin_lang') as $key=>$lang){
                $table->string('notes_'.$key)->nullable();
            }

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('config_upload_filters');
    }
};

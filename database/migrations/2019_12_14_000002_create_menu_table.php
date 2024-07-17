<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('type')->nullable();

            $table->string('sel_routs')->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('roleView')->nullable();

            $table->integer('is_active')->default('1');
            $table->integer('postion')->default('30');

        });

    }

    public function down(): void {
        Schema::dropIfExists('config_menu');
    }
};

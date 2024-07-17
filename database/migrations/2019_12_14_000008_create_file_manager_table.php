<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_file_manager', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->nullable();
            $table->string('type')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('config_file_manager');
    }
};

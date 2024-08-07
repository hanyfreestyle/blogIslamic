<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_site_maps', function (Blueprint $table) {
            $table->id();
            $table->string('cat_id');
            $table->string('name');
            $table->integer('url_count')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('config_site_maps');
    }

};

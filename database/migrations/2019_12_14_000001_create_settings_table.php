<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('config_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_url')->nullable();
            $table->integer('web_status')->default('1');
            $table->integer('switch_lang')->default('1');
            $table->integer('users_login')->default('1');
            $table->integer('serach')->default('1');
            $table->integer('serach_type')->default('1');
            $table->integer('wish_list')->default('1');

            $table->string('phone_num')->nullable();
            $table->string('whatsapp_num')->nullable();
            $table->string('phone_call')->nullable();
            $table->string('whatsapp_send')->nullable();
            $table->string('email')->nullable();
            $table->string('def_url')->nullable();

            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('google_api')->nullable();

            $table->integer('telegram_send')->nullable();
            $table->string('telegram_key')->nullable();
            $table->string('telegram_phone')->nullable();
            $table->string('telegram_group')->nullable();

            $table->integer('page_about')->default('1');
            $table->integer('page_warranty')->default('1');
            $table->integer('page_shipping')->default('1');
            $table->integer('pro_sale_lable')->default('1');
            $table->integer('pro_quick_view')->default('1');
            $table->integer('pro_quick_shop')->default('1');
            $table->integer('pro_warranty_tab')->default('1');
            $table->integer('pro_shipping_tab')->default('1');
            $table->integer('pro_social_share')->default('1');

            $table->integer('pro_free_shipping')->default('1');
            $table->json('pro_main_city_id')->nullable();
            $table->integer('pro_main_city_rate')->nullable();
            $table->integer('pro_main_city_discount')->nullable();
            $table->integer('pro_all_city_rate')->nullable();
            $table->integer('pro_all_city_discount')->nullable();



        });


        Schema::create('config_setting_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('setting_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('closed_mass')->nullable();
            $table->unique(['setting_id','locale']);
            $table->foreign('setting_id')->references('id')->on('config_settings')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('config_setting_translations');
        Schema::dropIfExists('config_settings');
    }
};

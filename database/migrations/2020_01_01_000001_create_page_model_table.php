<?php

use App\AppPlugin\Pages\Traits\PageConfigTraits;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        $Config = PageConfigTraits::DbConfig();

        if ($Config['TableCategory']) {
            Schema::create('page_categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->integer('deep')->default(0);
                $table->string("icon")->nullable();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->boolean("is_active")->default(true);
                $table->integer('postion')->default(0);
                $table->timestamps();
            });

            Schema::create('page_category_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('category_id')->unsigned();
                $table->string('locale')->index();
                $table->string('slug');
                $table->string('name')->nullable();
                $table->text('des')->nullable();
                $table->string('g_title')->nullable();
                $table->text('g_des')->nullable();


                $table->unique(['category_id', 'locale']);
                $table->unique(['locale', 'slug']);
                $table->foreign('category_id')->references('id')->on('page_categories')->onDelete('cascade');
            });
        }

        Schema::create('page_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->boolean("is_active")->nullable()->default(true);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->integer('url_type')->nullable()->default(0);
            $table->string('youtube')->nullable();
            $table->date('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('youtube_title')->nullable();

            $table->unique(['page_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('page_id')->references('id')->on('page_pages')->onDelete('cascade');
        });

        if ($Config['TableReview']) {
            Schema::create('page_review', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('post_id')->unsigned();
                $table->dateTime('updated_at');
                $table->foreign('post_id')->references('id')->on('page_pages')->onDelete('cascade');
            });
        }


        if ($Config['TableCategory']) {
            Schema::create('pagecategory_page', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('category_id');
                $table->unsignedBiginteger('page_id');
                $table->integer('postion')->default(0);

                $table->foreign('category_id')->references('id')
                    ->on('page_categories')->onDelete('cascade');

                $table->foreign('page_id')->references('id')
                    ->on('page_pages')->onDelete('cascade');
            });
        }

        if ($Config['TableMorePhotos']) {
            Schema::create('page_photos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('page_id')->unsigned();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->string("photo_thum_2")->nullable();
                $table->integer("position")->default(0);
                $table->integer("print_photo")->default(2);
                $table->integer("is_default")->default(0);
                $table->foreign('page_id')->references('id')->on('page_pages')->onDelete('cascade');
            });

            Schema::create('page_photo_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('photo_id')->unsigned();
                $table->string('locale')->index();
                $table->longText('des')->nullable();
                $table->unique(['photo_id', 'locale']);
                $table->foreign('photo_id')->references('id')->on('page_photos')->onDelete('cascade');;
            });
        }


        if ($Config['TableTags']) {

            Schema::create('page_tags', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->boolean("is_active")->default(true);
            });

            Schema::create('page_tags_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('tag_id')->unsigned();
                $table->string('locale')->index();
                $table->string('slug')->nullable();
                $table->string('name')->nullable();
                $table->unique(['tag_id', 'locale']);
                $table->unique(['locale', 'slug']);
                $table->foreign('tag_id')->references('id')->on('page_tags')->onDelete('cascade');
            });

            Schema::create('page_tags_post', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('tag_id');
                $table->unsignedBiginteger('post_id');

                $table->foreign('tag_id')->references('id')->on('page_tags')->onDelete('cascade');
                $table->foreign('post_id')->references('id')->on('page_pages')->onDelete('cascade');
            });
        }

    }

    public function down(): void {
        Schema::dropIfExists('page_tags_post');
        Schema::dropIfExists('page_tags_translations');
        Schema::dropIfExists('page_tags');
        Schema::dropIfExists('page_photo_translations');
        Schema::dropIfExists('page_photos');
        Schema::dropIfExists('pagecategory_page');
        Schema::dropIfExists('page_review');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('page_pages');
        Schema::dropIfExists('page_category_translations');
        Schema::dropIfExists('page_categories');
    }
};

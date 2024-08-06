<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;

return new class extends Migration {

    public function up(): void {
        $Config = BlogConfigTraits::DbConfig();

        if ($Config['TableCategory']) {

            Schema::create('blog_categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->integer('old_id')->nullable();
                $table->integer('old_parent')->nullable();
                $table->integer('count')->nullable();

                $table->integer('deep')->default(0);
                $table->string("icon")->nullable();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->boolean("is_active")->default(true);
                $table->integer('postion')->default(0);
                $table->timestamps();
            });

            Schema::create('blog_category_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('category_id')->unsigned();
                $table->string('locale')->index();
                $table->string('slug')->nullable();
                $table->string('name')->nullable();
                $table->longText('des')->nullable();
                $table->string('g_title')->nullable();
                $table->text('g_des')->nullable();
                $table->unique(['category_id', 'locale']);
                $table->unique(['locale', 'slug']);
                $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            });
        }


        Schema::create('blog_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('old_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


//            $table->integer('old_cat')->nullable();
//            $table->text('old_tags')->nullable();
//            $table->integer('update_tags')->nullable();
//            $table->integer('cat_id')->nullable();
//            $table->string('post_status')->nullable();

            $table->boolean("is_active")->nullable()->default(true);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
//            $table->integer('url_type')->nullable()->default(0);
//            $table->string('youtube')->nullable();

            $table->date('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('view_count')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('blog_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('blog_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->longText('des_text')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('youtube_title')->nullable();
            $table->integer('slug_count')->nullable();
            $table->integer('clean_des')->nullable();

            $table->unique(['blog_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
        });


        if ($Config['TableReview']) {
            Schema::create('blog_post_review', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('blog_id')->unsigned();
                $table->string('name')->nullable();
                $table->longText('des')->nullable();
                $table->integer('loop_index')->nullable();
                $table->dateTime('updated_at');
                $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
            });
        }


        if ($Config['TableCategory']) {
            Schema::create('blogcategory_blog', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('category_id');
                $table->unsignedBiginteger('blog_id');
                $table->integer('postion')->default(0);

                $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
                $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
            });
        }

        if ($Config['TableTags']) {
            Schema::create('blog_tags', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('old_id')->nullable();
                $table->integer('count')->nullable();
                $table->integer('old_count')->nullable();
                $table->boolean("is_active")->default(true);
            });


            Schema::create('blog_tags_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('tag_id')->unsigned();
                $table->string('locale')->index();
                $table->string('slug')->nullable();
                $table->string('name')->nullable();
                $table->integer('trim')->nullable();
                $table->unique(['tag_id', 'locale']);
                $table->unique(['locale', 'slug']);
                $table->foreign('tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
            });

            Schema::create('blog_tags_post', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBiginteger('tag_id');
                $table->unsignedBiginteger('blog_id');

                $table->foreign('tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
                $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
            });
        }

        if($Config['TableMorePhotos']){
            Schema::create('blog_photos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('blog_id')->unsigned();
                $table->string("photo")->nullable();
                $table->string("photo_thum_1")->nullable();
                $table->string("photo_thum_2")->nullable();
                $table->integer("position")->default(0);
                $table->integer("print_photo")->default(2);
                $table->integer("is_default")->default(0);
                $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
            });

            Schema::create('blog_photo_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('photo_id')->unsigned();
                $table->string('locale')->index();
                $table->longText('des')->nullable();
                $table->unique(['photo_id', 'locale']);
                $table->foreign('photo_id')->references('id')->on('blog_photos')->onDelete('cascade');;
            });
        }

    }

    public function down(): void {
        Schema::dropIfExists('blog_photo_translations');
        Schema::dropIfExists('blog_photos');
        Schema::dropIfExists('blog_tags_post');
        Schema::dropIfExists('blog_tags_translations');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blogcategory_blog');
        Schema::dropIfExists('blog_post_review');
        Schema::dropIfExists('blog_translations');
        Schema::dropIfExists('blog_post');
        Schema::dropIfExists('blog_category_translations');
        Schema::dropIfExists('blog_categories');
    }

};

<?php

namespace App\AppPlugin\Crm\WordPress;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogCategoryTranslation;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTagsTranslation;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Illuminate\Support\Facades\DB;

class WordPressController extends AdminMainController {

    function __construct() {
        parent::__construct();

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateDates() {

       $blogs = BlogReview::query()->get();
       foreach ($blogs as $blog){
           $blog->updated_at  = "2024-04-15 00:00:00";
           $blog->save();
       }

        $blogs = Blog::query()->get();
        foreach ($blogs as $blog){
            $blog->created_at  = "2024-04-15 00:00:00";
            $blog->updated_at  = "2024-04-15 00:00:00";
            $blog->published_at  = "2024-04-15 ";
            $blog->save();
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CleanBreakLine() {

        $allData = BlogTranslation::query()
            ->where('clean_des', null)
//            ->where('id', 4608)
            ->take(500)
            ->get();

        foreach ($allData as $data) {

            $des = $data->des;
            $descleane = $data->des;

            $descleane = str_replace('<!--more-->', '', $descleane);
            $descleane = preg_replace('%(\[caption\b[^\]]*\](.*?)(\[\/caption]))%', '$2', $descleane);
            $descleane = self::nl2p($descleane, false, true);
            $descleane = str_replace('<br />', '', $descleane);
            $descleane = str_replace('<p></p>', '', $descleane);

            $destext = AdminHelper::textClean($descleane);

            $data->clean_des = 1;
            $data->des_text = $destext;
            $data->des = $descleane;
//             $data->save();
        }

        echobr(BlogTranslation::query()->where('clean_des', null)->count());

//        return view('AppPlugin.CrmWordPress.index')->with([
//            'des' => $des,
//            'descleane' => $descleane,
//            'destext' => $destext,
//
//
//        ]);

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function nl2p($string, $line_breaks = true, $xml = true) {
        $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);

        if ($line_breaks == true)
            return '<p>' . preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br' . ($xml == true ? ' /' : '') . '>$2'), trim($string)) . '</p>';
        else
            return preg_replace(
                array("/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"),
                array("</p>\n<p>", "</p>\n<p>", '$1<br' . ($xml == true ? ' /' : '') . '>$2'),
                trim($string));
    }


    public function nl2p_sours($string, $line_breaks = true, $xml = true) {
        $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);

        if ($line_breaks == true)
            return '<p>' . preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br' . ($xml == true ? ' /' : '') . '>$2'), trim($string)) . '</p>';
        else
            return '<p>' . preg_replace(
                    array("/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"),
                    array("</p>\n<p>", "</p>\n<p>", '$1<br' . ($xml == true ? ' /' : '') . '>$2'),
                    trim($string)) . '</p>';
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function DesText() {
        $names = BlogTranslation::query()->where('des_text', null)->take(500)->get();
        foreach ($names as $name) {
            $name->des_text = AdminHelper::textClean($name->des);
            $name->save();
        }
        echobr(BlogTranslation::query()->where('des_text', null)->count());
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function TrimTags() {
        $tags = BlogTagsTranslation::query()->where('trim', null)->take(5000)->get();
        foreach ($tags as $tag) {
            $tag->name = AdminHelper::Url_Slug($tag->name, ['delimiter' => ' ']);
            $tag->trim = 1;
            $tag->save();
        }
        echobr(BlogTagsTranslation::query()->where('trim', null)->count());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function TrimBlogName() {
        $names = BlogTranslation::query()->where('slug_count', 1)->take(500)->get();
//        $names = BlogTranslation::query()->where('id',2360)->get();
        foreach ($names as $name) {
            $name->name = trim(AdminHelper::Url_Slug($name->name, ['delimiter' => ' ']));
            $name->slug_count = null;
            $name->save();
        }
        echobr(BlogTranslation::query()->where('slug_count', 1)->count());
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function UpdatePostStatus() {

        $blog = Blog::query()->get()->groupBy('post_status');
        $blog = Blog::query()
            ->where('post_status', 'pending')
            ->orWhere('post_status', 'draft')
            ->get();
//        foreach ($blog as $post){
//            $post->is_active = 0 ;
//            $post->timestamps = false;
//            $post->save();
//        }


//
//        dd($blog);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function index() {

        $pageData['ViewType'] = "List";


        return view('AppPlugin.CrmWordPress.index', compact('pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function ImportCategory() {
        $cats = Taxonomy::category()->get();
        dd($cats);
        $SaveData = 1;
        $index = 0;

        foreach ($cats as $cat) {
            echobr($cat->term->name ?? '');
            echobr($cat->term->slug ?? '');
            echobr($cat->term_taxonomy_id ?? '');
            echobr($cat->description ?? '');
            echobr($cat->parent ?? '');
            echobr($cat->count ?? '');
            echobr("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$");

            if ($SaveData and $index > 0) {
                $newCat = new BlogCategory();

                $newCat->old_id = $cat->term_taxonomy_id;
                $newCat->old_parent = $cat->parent;
                $newCat->count = $cat->count;
                $newCat->save();

                $newTranslation = new BlogCategoryTranslation();
                $newTranslation->category_id = $newCat->id;
                $newTranslation->locale = "ar";
                $newTranslation->slug = urldecode($cat->term->slug);
                $newTranslation->name = $cat->term->name;
                $newTranslation->des = $cat->description;
                $newTranslation->g_title = $cat->term->name;
                $newTranslation->g_des = AdminHelper::seoDesClean($cat->description);
                $newTranslation->save();
            }

            $index++;

        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function ImportTags() {
        set_time_limit(0);
        $SaveData = 1;
        dd('done');
        if ($SaveData) {
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->count();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(0)->take(10000)->get();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(10000)->take(20000)->get();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(30000)->take(10000)->get();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(40000)->take(10000)->get();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(50000)->take(10000)->get();
//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->skip(60000)->take(10000)->get();

//            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->take('1')->get();
        } else {
            $tags = Taxonomy::where('taxonomy', 'post_tag')->with('term')->take('1')->get();
        }

        foreach ($tags as $tag) {

            $newTag = new BlogTags();
            $newTag->old_id = $tag->term_id;
            $newTag->count = $tag->count;
            $newTag->old_count = $tag->count;

            if ($SaveData) {
                $newTag->save();
                $newTranslation = new BlogTagsTranslation();
                $newTranslation->tag_id = $newTag->id;
                $newTranslation->locale = "ar";
                $newTranslation->slug = urldecode($tag->term->slug);
                $newTranslation->name = $tag->term->name;
                $newTranslation->save();
            } else {
                echobr($tag->term_id);
                echobr($tag->count);
                echobr($tag->term->name);
                echobr(urldecode($tag->term->slug));
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function ImportPosts() {
        set_time_limit(0);
        $SaveData = 1;
        if ($SaveData) {
            dd('hi');

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')
//                ->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(0)->take(250)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(250)->take(250)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(500)->take(250)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(750)->take(250)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(1000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(1500)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(2000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(2500)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(3000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(3500)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(4000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(4500)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(5000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(5500)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(6000)->take(500)->get();

//            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')->with('attachment')->with('taxonomies')->orderBy('ID')
//                ->skip(6500)->take(500)->get();

        } else {
            $posts = Post::query()->where('post_type', 'post')->where('post_status', '!=', 'trash')
                ->with('attachment')->with('taxonomies')
                ->take(1)
                ->orderBy('ID')
                ->get();
//            dd($posts);
        }


        foreach ($posts as $post) {


            $tagArr = array();
            if ($SaveData == 0) {
                echobr($post->ID);
                echobr($post->post_author);
                echobr($post->post_date);
                echobr($post->post_modified);
                echobr($post->post_status);
                echobr(urldecode($post->post_name));
                echobr(self::UpdatePhotoPath($post->thumbnail->attachment->guid ?? ''));
            }


            if (isset($post->thumbnail->attachment->guid)) {
                $photo = self::UpdatePhotoPath($post->thumbnail->attachment->guid);
            } else {
                $photo = null;
            }


            $newPost = new Blog();
            $newPost->old_id = $post->ID;
            $newPost->user_id = $post->post_author;
            $newPost->post_status = $post->post_status;
            $newPost->published_at = $post->post_date;
            $newPost->created_at = $post->post_date;
            $newPost->updated_at = $post->post_modified;
            $newPost->photo = $photo;
            $newPost->photo_thum_1 = $photo;

            foreach ($post->taxonomies as $taxonomies) {
                if ($taxonomies->taxonomy == 'post_tag') {
                    $tagArr = array_merge($tagArr, [$taxonomies->term_id]);
                }
                if ($taxonomies->taxonomy == 'category') {
                    $newPost->old_cat = $taxonomies->term_id;
                }
            }

            $newPost->old_tags = serialize($tagArr);

            if ($SaveData) {
                $newPost->save();
            }

            $newTranslation = new BlogTranslation();
            $newTranslation->blog_id = $newPost->id;
            $newTranslation->locale = "ar";
            $newTranslation->slug = urldecode($post->post_name);;
            $newTranslation->name = $post->post_title;
            $newTranslation->des = $post->post_content;
            if ($SaveData) {
                $newTranslation->save();
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function syncBlogCategory() {
//        dd('hi');
        $AllCats = BlogCategory::all();
        foreach ($AllCats as $cat) {
            $thisId = $cat->id;
            $oldId = $cat->old_id;
            $AllPost = Blog::where('old_cat', $oldId)->get();
            foreach ($AllPost as $post) {
                $post->categories()->sync([$thisId]);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function syncTags() {
        set_time_limit(0);
//        dd('hi');
        $AllPost = Blog::where('update_tags', null)->take(250)->get();
        foreach ($AllPost as $post) {
            $oldTags = unserialize($post->old_tags);
            $newTags = array();
            foreach ($oldTags as $oldTag) {
                $newTagModel = BlogTags::where('old_id', $oldTag)->first();
                $newTags = array_merge($newTags, [$newTagModel->id]);
            }
            $post->tags()->sync($newTags);
            $post->timestamps = false;
            $post->update_tags = 1;
            $post->save();
        }
        echobr(Blog::where('update_tags', null)->count());

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function UpdatePhotoPath($url) {
        $thumbnail = str_replace(['https://islamic-dreams-interpretation.com', 'http://islamic-dreams-interpretation.com'], ['', ''], $url);
        return $thumbnail;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function CountSlug() {
        set_time_limit(0);
        $blogs = BlogTranslation::where('slug_count', null)->take(1000)->get();
        foreach ($blogs as $blog) {
            $count = BlogTranslation::where('slug', $blog->slug)->count();
            $blog->slug_count = $count;
            $blog->save();
        }
        echobr(BlogTranslation::where('slug_count', null)->count());
        echobr(BlogTranslation::where('slug_count', '>', 1)->count());
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function UpdateErrSlug() {
        dd('needCheckPls');
        set_time_limit(0);
        $blogs = BlogTranslation::where('slug_count', '>', 1)->take(500)->get();
        foreach ($blogs as $blog) {
            $blog->slug = $blog->slug . "-" . $blog->id;
            $count = BlogTranslation::where('slug', $blog->slug)->count();
            $blog->slug_count = $count;
            $blog->save();
        }
        echobr(BlogTranslation::where('slug_count', null)->count());
        echobr(BlogTranslation::where('slug_count', '>', 1)->count());
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function UpdateErrSlugNew() {
        set_time_limit(0);
        $blogs = BlogTranslation::where('slug_count', 0)->take(500)->get();
        foreach ($blogs as $blog) {

//            $blog->slug = AdminHelper::Url_Slug($blog->name." ".$blog->id);

//            $blog->save();
            $count = BlogTranslation::where('slug', $blog->slug)->count();
            $blog->slug_count = $count;
            $blog->save();
//            echobr($blog->slug);
        }
        echobr(BlogTranslation::where('slug_count', null)->count());
        echobr(BlogTranslation::where('slug_count', 0)->count());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| #
    public function CheckId() {
//        $posts = Post::published()->where('post_type', 'post')->where('ID', 53172)->get();
//        dd($posts);

        $old_listing = DB::connection('mysql2')->table('wp_users')->first();
        dd($old_listing);
    }







    /*

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #
        public function UpdateMeta($saveData, $row, $val) {
            $saveTranslation = BlogTranslation::where("blog_id", $saveData)->where('locale', 'ar')->first();
            if ($saveTranslation != null) {
                $saveTranslation->$row = $val;
                $saveTranslation->save();
            }
        }


    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #
        public function indexSSSS() {

            $posts = Post::published()->where('post_type', 'post')->take(25)->get();

            foreach ($posts as $post) {
                echobr($post->ID);
                echobr('##############################################');

                $newPost = new Blog();
                $newPost->old_id = $post->ID;
                $newPost->created_at = $post->post_date;
                $newPost->updated_at = $post->post_modified;
                $newPost->published_at = Carbon::parse($post->post_date)->format("Y-m-d");
                if ($post->thumbnail != null) {
                    $thumbnail = str_replace('https://cottton.shop/', '', $post->thumbnail);
                    $newPost->photo = $thumbnail;
                    $newPost->photo_thum_1 = $thumbnail;
                }
                $newPost->save();

                $newTranslation = new BlogTranslation();
                $newTranslation->blog_id = $newPost->id;
                $newTranslation->locale = "ar";
                $newTranslation->slug = urldecode($post->post_name);;
                $newTranslation->name = $post->post_title;
                $newTranslation->des = $post->post_content;
                $newTranslation->save();

                foreach ($post->meta as $meta) {
                    $Line = $meta->meta_key . " > " . $meta->meta_value;

                    if ($meta->meta_key == '_yoast_wpseo_primary_category') {
                        $newPost->old_cat = $meta->meta_value;
                        $newPost->save();
                    }

                    if ($meta->meta_key == '_yoast_post_redirect_info') {
                        $newPost->redirect_info = $meta->meta_value;
                        $newPost->save();
                    }


                    if ($meta->meta_key == '_yoast_wpseo_title') {
                        self::UpdateMeta($newPost->id, 'g_title', $meta->meta_value);
                    }

                    if ($meta->meta_key == '_yoast_wpseo_metadesc') {
                        self::UpdateMeta($newPost->id, 'g_des', $meta->meta_value);
                    }


                    echobr($Line);

                }
                echobr("----------------------------");
            }

        }

    */

//    public function CheckUser() {
//
//        $blogs = Blog::where('new_post', 1)->take(500)->get();
//        foreach ($blogs as $blog) {
//            $post = Post::published()->where('post_type', 'post')->where('ID', $blog->old_id)->first();
//            $blog->new_post = 0;
//            $blog->created_at = $post->post_date;
//            $blog->updated_at = $post->post_modified;
//            $blog->save();
//        }
//        echobr(Blog::where('new_post', 1)->count());
//    }

}



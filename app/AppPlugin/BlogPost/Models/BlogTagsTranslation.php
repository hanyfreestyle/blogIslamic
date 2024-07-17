<?php

namespace App\AppPlugin\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogTagsTranslation extends Model {


    public $timestamps = false;
    protected $table = "blog_tags_translations";
    protected $fillable = ['name'];
}

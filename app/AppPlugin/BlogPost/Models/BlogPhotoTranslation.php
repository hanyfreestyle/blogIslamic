<?php

namespace App\AppPlugin\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogPhotoTranslation extends Model {


    public $timestamps = false;
    protected $table = "blog_photo_translations";
    protected $fillable = ['des'];
}

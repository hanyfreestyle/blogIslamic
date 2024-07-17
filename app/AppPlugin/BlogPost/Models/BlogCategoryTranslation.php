<?php

namespace App\AppPlugin\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model {


    public $timestamps = false;
    protected $table = "blog_category_translations";
    protected $fillable = ['name'];
}

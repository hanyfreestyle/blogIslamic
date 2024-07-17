<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTagsTranslation extends Model {


    public $timestamps = false;
    protected $table = "page_tags_translations";
    protected $fillable = ['name'];
}

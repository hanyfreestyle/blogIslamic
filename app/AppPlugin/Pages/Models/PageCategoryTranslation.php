<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageCategoryTranslation extends Model {


    public $timestamps = false;
    protected $table = "page_category_translations";
    protected $fillable = ['name'];
}

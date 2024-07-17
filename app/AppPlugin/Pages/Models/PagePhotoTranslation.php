<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PagePhotoTranslation extends Model {


    public $timestamps = false;
    protected $table = "page_photo_translations";
    protected $fillable = ['des'];
}

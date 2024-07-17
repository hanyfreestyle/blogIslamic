<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model {

    public $timestamps = false;
    protected $table = "page_translations";
    protected $fillable = ['name'];

}

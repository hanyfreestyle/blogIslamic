<?php

namespace App\AppPlugin\Config\Meta;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTag extends Model implements TranslatableContract {

  use Translatable;
  use SoftDeletes;

  protected $table = "config_meta_tags";
  protected $primaryKey = 'id';
  public $translatedAttributes = ['g_title', 'g_des','des','name'];
  protected $fillable = ['cat_id'];


}

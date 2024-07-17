<?php

namespace App\AppPlugin\Config\Privacy;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPrivacy extends Model implements TranslatableContract {

  use Translatable;
  use SoftDeletes;

  public $translatedAttributes = ['h1', 'h2', 'des', 'lists'];
  protected $fillable = ['id', 'name', 'postion', 'postion'];
  protected $table = "config_web_privacies";
  protected $primaryKey = 'id';
  protected $translationForeignKey = 'privacy_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
  public function scopeDefquery(Builder $query): Builder {
    return $query->with('translations');
  }

}

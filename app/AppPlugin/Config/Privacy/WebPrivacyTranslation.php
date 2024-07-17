<?php

namespace App\AppPlugin\Config\Privacy;


use Illuminate\Database\Eloquent\Model;

class WebPrivacyTranslation extends Model {

  public $timestamps = false;
  protected $table = "config_web_privacy_translations";
  protected $fillable = ['h1', 'h2', 'des', 'lists'];

}

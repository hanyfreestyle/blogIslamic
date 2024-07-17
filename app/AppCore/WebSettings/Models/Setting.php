<?php

namespace App\AppCore\WebSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract {

    use Translatable;

    public $translatedAttributes = ['name', 'g_title', 'g_des', 'closed_mass'];
    protected $fillable = ['facebook', 'twitter', 'youtube', 'instagram', 'google_api', 'web_status', 'phone_num', 'whatsapp_num'];
    protected $table = "config_settings";
    protected $primaryKey = 'id';
    public $timestamps = false;


}

<?php

namespace App\AppCore\WebSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model {

    public $timestamps = false;
    protected $table = "config_setting_translations";
    protected $fillable = ['name', 'g_title', 'g_des', 'closed_mass'];
}

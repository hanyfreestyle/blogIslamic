<?php

namespace App\AppCore\DefPhoto;


use Illuminate\Database\Eloquent\Model;

class DefPhoto extends Model {
    protected $table = "config_def_photos";
    protected $fillable = ['cat_id', 'photo', 'postion', 'created_at', 'updated_at'];
}

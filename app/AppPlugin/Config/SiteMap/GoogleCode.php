<?php
namespace App\AppPlugin\Config\SiteMap;

use Illuminate\Database\Eloquent\Model;

class GoogleCode extends Model{

    protected $table = "config_site_robots";
    protected $primaryKey = 'id';
    protected $fillable = [];

}

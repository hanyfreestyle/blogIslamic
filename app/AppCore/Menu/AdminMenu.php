<?php

namespace App\AppCore\Menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminMenu extends Model {

    protected $table = "config_menu";
    protected $primaryKey = 'id';
    protected $fillable = ['cat_id'];
    public $timestamps = false;

    public function subMenu(): HasMany {
        return $this->hasMany(AdminMenu::class,'parent_id')->orderBy('postion');
    }

}

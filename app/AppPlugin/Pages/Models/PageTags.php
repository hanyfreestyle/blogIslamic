<?php
namespace App\AppPlugin\Pages\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class PageTags extends Model implements TranslatableContract {

    use Translatable;

    public $translatedAttributes = ['name','slug'];
    protected $fillable = [];
    protected $table = "page_tags";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'tag_id';
    public $timestamps = false;

    public function scopeDef(Builder $query): Builder {
        return $query->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # tags
    public function pages(): BelongsToMany {
        return $this->belongsToMany(Page::class,'page_tags_post','tag_id', 'post_id');
    }


}

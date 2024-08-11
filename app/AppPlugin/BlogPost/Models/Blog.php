<?php


namespace App\AppPlugin\BlogPost\Models;

use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'des', 'other', 'slug','des_text'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'postion', 'text_view', 'url_type','updated_at'];
    protected $table = "blog_post";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'blog_id';


    public function loadMoleConfig() {
       return  BlogConfigTraits::DbConfig();
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     tablename
    public function tablename(): HasMany {
        return $this->hasMany(BlogTranslation::class)->select('id', 'blog_id', 'name');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     tablename
    public function arName(): HasOne {
        return $this->hasOne(BlogTranslation::class)->select('id', 'blog_id', 'name')->where('locale', 'ar');
    }

    public function enName(): HasOne {
        return $this->hasOne(BlogTranslation::class)->select('id', 'blog_id', 'name')->where('locale', 'en');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDef(Builder $query): Builder {
        $config = self::loadMoleConfig();
        $query->with('translations');

        if ($config['TableCategory']) {
            $query->with('categories');
        }
        if ($config['TableMorePhotos']) {
            $query->withCount('more_photos');
        }
        return $query;
    }

    public function getFormatteDate() {
        if ($this->published_at) {
            return Carbon::parse($this->published_at)->format("Y-m-d");
        } else {
            return null;
        }
    }

    public function getHomeFormatteDate() {
        return Carbon::parse($this->published_at)->locale(app()->getLocale())->translatedFormat('jS M Y');
    }

    public function getUpdateFormatteDate() {
        return Carbon::parse($this->updated_at)->locale(app()->getLocale())->translatedFormat('jS M Y');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # categories
    public function categories(): BelongsToMany {
        return $this->belongsToMany(BlogCategory::class, 'blogcategory_blog', 'blog_id', 'category_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # tags
    public function tags(): BelongsToMany {
        return $this->belongsToMany(BlogTags::class, 'blog_tags_post', 'blog_id', 'tag_id');
    }

    public function userName(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews(): HasMany {
        return $this->hasMany(BlogReview::class, 'blog_id')
            ->with('userName')
            ->orderBy('id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefquery(Builder $query): Builder {
        return $query->with('translations');
    }

    public function scopedefWeb(Builder $query): Builder {
        return $query->where('is_active',true);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefhomequery(Builder $query): Builder {
        return $query->where('is_active', true)
            ->whereDate('published_at', '<=', today())
            ->with('translation')->with('user')
            ->orderBy('published_at', 'desc')
            ->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefinRandomOrder(Builder $query): Builder {
        return $query->where('is_active', true)
            ->whereDate('published_at', '<=', today())
            ->with('translations')->with('user')
            ->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # more_photos
    public function more_photos(): HasMany {
        return $this->hasMany(BlogPhoto::class, 'blog_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }


}

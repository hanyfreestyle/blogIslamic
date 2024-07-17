<?php

namespace App\AppPlugin\BlogPost\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogReview extends Model {
    public $timestamps = false;
    protected $table = "blog_post_review";


    public function userName(): BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }


}

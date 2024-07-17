<?php

namespace App\AppCore\UploadFilter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadFilterSize extends Model {

    public $timestamps = false;
    protected $table = "config_upload_filter_sizes";

    public function filter(): BelongsTo {
        return $this->belongsTo(UploadFilter::class);
    }
}

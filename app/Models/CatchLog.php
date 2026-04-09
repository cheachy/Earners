<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatchLog extends Model
{
    // This tells Laravel: "Do not block any columns. Allow everything to be saved."
    protected $guarded = []; 

    protected $casts = [
        'date_caught' => 'date',
    ];

    public function fisherProfile(): BelongsTo
    {
        return $this->belongsTo(FisherProfile::class, 'fisher_profile_id');
    }
}
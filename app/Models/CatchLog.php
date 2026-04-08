<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatchLog extends Model {
    protected $casts = [
        'date_caught' => 'date',
    ];

    public function fisherProfile() {
        return $this->belongsTo(FisherProfile::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
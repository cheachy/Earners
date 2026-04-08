<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
    protected $casts = [
        'sale_date' => 'datetime',
    ];

    public function catchLog() {
        return $this->belongsTo(CatchLog::class);
    }
}

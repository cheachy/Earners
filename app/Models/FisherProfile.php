<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FisherProfile extends Model {
    protected $fillable = ['user_id', 'contact_number', 'location_zone', 'preferred_payment'];

    /**
     * Define the relationship to the User.
     */
    public function user(): BelongsTo // Add the return type hint
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship to CatchLogs.
     */
    public function catchLogs(): HasMany
    {
        return $this->hasMany(CatchLog::class);
    }
}
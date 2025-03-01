<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'player_id',
        'amount',
        'type',
        'description',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}

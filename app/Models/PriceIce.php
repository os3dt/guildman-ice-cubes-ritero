<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceIce extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'db_item_id',
        'one',
        'stack',
        'shulker',
    ];

    public function dbItem(): BelongsTo
    {
        return $this->belongsTo(DBItem::class, 'db_item_id');
    }

    public function dbPrice(): HasOne
    {
        return $this->hasOne(DBPrice::class, 'db_item_id', 'db_item_id');
    }
}

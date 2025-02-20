<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DBPrice extends Model
{
    use SoftDeletes;

    protected $table = 'db_prices';

    protected $fillable = [
        'db_item_id',
        'avg_one',
        'avg_stack',
        'avg_shulker',
    ];

    public function dbItem(): BelongsTo
    {
        return $this->belongsTo(DBItem::class, 'db_item_id');
    }
}

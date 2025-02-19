<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpawnProductsCost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'db_item_id',
        'one_stack',
        'one_shulker',
        'trader',
    ];

    public function dbItem(): BelongsTo
    {
        return $this->belongsTo(DBItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'server_id',
        'discord_id',
        'balance'
    ];

    public function balanceHistory(): HasMany
    {
        return $this->hasMany(BalanceHistory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'player_products')
            ->withTimestamps();
    }

    public function updateBalance(int $amount, string $type, string $description = null): void
    {
        $this->increment('balance', $amount);
        $this->balanceHistory()->create([
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        ]);
    }
}

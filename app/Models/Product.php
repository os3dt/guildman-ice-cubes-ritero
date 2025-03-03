<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_products')
            ->withTimestamps();
    }

    public function charge(Player $player): bool
    {
        if ($player->balance >= $this->price) {
            $player->updateBalance(-$this->price, 'Списание', "Оплата услуги: {$this->name}");
            $this->players()->attach($player->id);
            return true;
        }
        return false;
    }
}

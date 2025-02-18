<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DBItem extends Model
{
    use SoftDeletes;

    protected $table = 'db_items';

    protected $fillable = [
        'name',
        'icon',
        'stack',
    ];
}

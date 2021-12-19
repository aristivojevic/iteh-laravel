<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'city',
        'age',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playerGames()
    {
        return $this->hasMany(PlayerGame::class);
    }
}

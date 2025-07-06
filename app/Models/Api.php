<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    public function game()
    {
        return $this->hasMany(Game::class);
    }
}

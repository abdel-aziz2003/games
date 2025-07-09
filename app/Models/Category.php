<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->hasMany(Game::class);
    }
    // In App\Models\Category.php
    public function getSlugAttribute()
    {
        return \Illuminate\Support\Str::slug($this->name);
    }

}

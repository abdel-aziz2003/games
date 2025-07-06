<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function api()
    {
        return $this->belongsTo(Api::class);
    }
}

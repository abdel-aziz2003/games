<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $category_count = Category::count();
        $game_count = Game::count();
        $game_list = Game::orderBy('game_id', 'desc')->orderBy('created_at', 'desc')->limit(10)->get();
        return view('dashboard', ['category_count' => $category_count, 'game_count' => $game_count, 'game_list' => $game_list]);
    }
}

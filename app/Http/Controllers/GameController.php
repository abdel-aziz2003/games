<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index($filter = '--', $category = '--')
    {
        $ft = filter($filter);
        $and = $ft['and'];
        $vfilter = $ft['vfilter'];

        $category_list = Category::orderBy('name')->get();

        if ($category != '--') {
            $and = $and . " and category_id = $category ";
        }
        if (Auth::check()) {
            $list_count = 20;
        } else {
            $list_count = 30;
        }

        $list = Game::whereRaw("id > 0 $and")->orderBy('game_id', 'desc')->orderBy('created_at', 'desc')->paginate($list_count);

        if (Auth::check()) {
            return view('game.index', ['list' => $list, 'vfilter' => $vfilter, 'category_list' => $category_list]);
        } else {
            return view('game.index_front', ['list' => $list, 'vfilter' => $vfilter, 'category_list' => $category_list, 'category' => $category]);
        }
    }

    public function create($id = '--')
    {
        if ($id != '--') {
            $info = Game::find($id);
        }
        $category_list = Category::orderBy('name')->get();
        return view('game.create', ['info' => @$info, 'id' => $id, 'category_list' => $category_list]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'instructions' => 'required',
            'url' => 'required',
            'category' => 'required',
            'thumb' => 'required'
        ]);

        if ($request->has('id')) {
            $table = Game::find($request->input('id'));
        } else {
            $table = new Game();
        }
        $game_id = Game::max('game_id') ?? 1;

        $table->game_id = $game_id;
        $table->title = $request->input('title');
        $table->description = $request->input('description');
        $table->instructions = $request->input('instructions');
        $table->url = $request->input('url');
        $table->category_id = $request->input('category');
        $table->thumb = $request->input('thumb');
        if ($request->input('id') == '') {
            $table->api_id = 2;
        }

        $table->save();

        return redirect()->route('game')->with('status', 'Game saved');
    }

    public function delete($id)
    {
        $table = Game::find($id);
        $table->delete();
        return redirect()->back()->with('status', 'Game deleted');
    }

    // public function play(Request $request, $id)
    // {
    //     $info = Game::find($id);
    //     //$request->session()->forget('my_view');
    //     if (session('my_view_' . $id) == '') {
    //         $info->view = $info->view + 1;
    //         $info->save();
    //         $request->session()->put('my_view_' . $id, ref());
    //     }
    //     $related_games = Game::where('category_id', $info->category_id)->inRandomOrder()->limit(8)->get();
    //     return view('game.play', ['info' => $info, 'related_games' => $related_games]);
    // }

public function play(Request $request, $title)
{
    // Convert slug back to readable title (dashes to spaces)
    $readableTitle = Str::of($title)->replace('-', ' ')->__toString();

    // Find game by title
    $info = Game::whereRaw('LOWER(title) = ?', [strtolower($readableTitle)])->firstOrFail();

    // Views tracking
    if (session('my_view_' . $info->id) == '') {
        $info->view += 1;
        $info->save();
        $request->session()->put('my_view_' . $info->id, true);
    }

    $related_games = Game::where('category_id', $info->category_id)->inRandomOrder()->limit(8)->get();

    return view('game.play', [
        'info' => $info,
        'related_games' => $related_games
    ]);
}


    public function like_game(Request $request)
    {
        $info = Game::find($request->input('id'));
        if ($request->session()->get('my_like_' . $request->input('id')) == '' && $request->session()->get('my_dislike_' . $request->input('id')) == '') {
            $info->thumb_up = $info->thumb_up + 1;
            $info->save();

            $request->session()->put('my_like_' . $request->input('id'), ref());
        }

        $res = ['count' => $info->thumb_up, 'code' => 200];
        echo json_encode($res);
    }

    public function dislike_game(Request $request)
    {
        $info = Game::find($request->input('id'));
        if ($request->session()->get('my_dislike_' . $request->input('id')) == '' && $request->session()->get('my_like_' . $request->input('id')) == '') {
            $info->thumb_down = $info->thumb_down + 1;
            $info->save();

            $request->session()->put('my_dislike_' . $request->input('id'), ref());
        }

        $res = ['count' => $info->thumb_down, 'code' => 200];
        echo json_encode($res);
    }
}

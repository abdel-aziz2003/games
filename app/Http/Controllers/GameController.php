<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index($category_slug = '--')
{
    $category_list = Category::orderBy('name')->get();

    $category_model = null;
    if ($category_slug !== '--') {
        $category_model = $category_list->first(function ($cat) use ($category_slug) {
            return \Illuminate\Support\Str::slug($cat->name) === strtolower($category_slug);
        });
    }

    $query = Game::query();

    if ($category_model) {
        $query->where('category_id', $category_model->id);
    }

    $list = $query->orderBy('game_id', 'desc')->orderBy('created_at', 'desc')->paginate(20);

    return view('game.index_front', [
        'list' => $list,
        'category_list' => $category_list,
        'category' => $category_model,
        'vfilter' => '',
    ]);
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
        'thumb' => 'required',
        'slug' => 'nullable|unique:games,slug,' . $request->input('id'),
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:1000',
    ]);

    if ($request->has('id')) {
        $table = Game::find($request->input('id'));
    } else {
        $table = new Game();
        $table->api_id = 2;
    }

    $game_id = Game::max('game_id') ?? 1;

    $table->game_id = $game_id;
    $table->title = $request->input('title');
    $table->slug = $request->input('slug') ?: Str::slug($request->input('title'));
    $table->meta_title = $request->input('meta_title');
    $table->meta_description = $request->input('meta_description');
    $table->description = $request->input('description');
    $table->instructions = $request->input('instructions');
    $table->url = $request->input('url');
    $table->category_id = $request->input('category');
    $table->thumb = $request->input('thumb');

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

public function play(Request $request, $slug)
{
    // Look up by slug directly (faster and cleaner)
    $info = Game::where('slug', $slug)->firstOrFail();

    if (session('my_view_' . $info->id) == '') {
        $info->view += 1;
        $info->save();
        $request->session()->put('my_view_' . $info->id, true);
    }

    $related_games = Game::where('category_id', $info->category_id)->inRandomOrder()->limit(8)->get();

    return view('game.play', [
        'info' => $info,
        'related_games' => $related_games,
        'title' => $info->meta_title ?? $info->title,
        'meta_description' => $info->meta_description ?? Str::limit(strip_tags($info->description), 150),
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

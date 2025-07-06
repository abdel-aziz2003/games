<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $list = Page::paginate(20);
        return view('page.index', ['list' => $list]);
    }

    public function create($id = '--')
    {
        if ($id != '--') {
            $info = Page::find($id);
        }
        return view('page.create', ['info' => @$info, 'id' => $id]);
    }

    public function store(Request $request)
    {
        if ($request->has('id')) {
            $table = Page::find($request->input('id'));
        } else {
            $table = new Page();
        }
        $table->name = $request->input('name');
        $table->content = $request->input('content');
        $table->save();

        return redirect()->route('page')->with('status', 'Page saved');
    }

    public function view($name)
    {
        // Get all pages (you may optimize this later)
        $page = Page::all()->first(function ($item) use ($name) {
            return Str::slug($item->name) === $name;
        });

        if (!$page) {
            abort(404);
        }

        return view('page.view', ['info' => $page]);
    }

    public function delete($id)
    {
        if(!in_array($id, [1,2,3]))
        {
        $table = Page::find($id);
        $table->delete();
        }
        return redirect()->back()->with('status', 'Page deleted');
    }
}

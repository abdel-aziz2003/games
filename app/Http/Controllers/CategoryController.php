<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $list = Category::orderBy('name')->get();
        return view('category.index', ['list' => $list]);
    }

    public function create($id = '--')
    {
        if ($id != '--') {
            $info = Category::find($id);
        }
        return view('category.create', ['info' => @$info, 'id' => $id]);
    }

    public function store(Request $request)
    {
        if ($request->has('id')) {
            $table = Category::find($request->input('id'));
        } else {
            $table = new Category();
        }
        $table->name = $request->input('name');
        $table->save();

        return redirect()->route('category')->with('status', 'Category saved');
    }

    public function delete($id)
    {
        $table = Category::find($id);
        $table->delete();
        return redirect()->back()->with('status', 'Category deleted');
    }
}

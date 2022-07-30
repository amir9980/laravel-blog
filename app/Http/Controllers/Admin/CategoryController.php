<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereParent_id(null)->paginate(5);
        return view('Admin.category.index',compact('categories'));
    }

    public function edit(Category $category)
    {
        Gate::authorize('update',$category);
        return view('Admin.category.edit',compact('category'));
    }

    public function create()
    {
        Gate::authorize('create',Category::class);
        return view('Admin.category.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('update',Category::class);
        $request->validate([
            'title'=>'required|string|max:100',
            'parent'=>'nullable|numeric'
        ]);

        Category::create([
           'title'=>$request->title,
           'parent_id'=>$request->parent
        ]);

        return redirect()->route('admin.category.index')->with(['message','done']);
    }

    public function update(Request $request,Category $category)
    {
        Gate::authorize('update',Category::class);
        $request->validate([
           'title'=>'required|string|max:100',
           'parent'=>'nullable|numeric'
        ]);

        $category->title = $request->title;
        $category->parent_id = is_null($request->parent) ? $category->parent_id : $request->parent;
        $category->save();
        return redirect()->route('admin.category.index')->with(['message','done']);

    }

}

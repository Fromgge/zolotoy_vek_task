<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $blog = Blog::create($request->only('title', 'content'));

        if ($request->has('categories')) {
            $categories = Category::find($request->input('categories'));
            $blog->categories()->attach($categories);
        }

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->only('title', 'content'));

        $blog->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.blogs.index');
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index');
    }
}


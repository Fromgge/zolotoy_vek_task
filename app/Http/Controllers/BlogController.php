<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Classes\AjaxHelper;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('categories')->get();

        return view('blogs.index', compact('blogs'));
    }

    public function view(int $id)
    {
        $blog = Blog::where('id', $id)->first();

        if (!$blog) {
            return redirect()->route('blogs.index');
        }

        return view('blogs.view', compact('blog'));
    }
}

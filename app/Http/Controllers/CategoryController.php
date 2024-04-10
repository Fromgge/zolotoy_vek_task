<?php

namespace App\Http\Controllers;

use App\Classes\AjaxHelper;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function view($id)
    {
        $category = Category::findOrFail($id);
        $blogs = $category->blogs()->orderBy('created_at', 'desc')->get();

        return view('categories.view', compact('blogs', 'category', 'id'));
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $category_id = $request->input('category_id');
        $order = $request->input('order');

        $blogs = Blog::search($category_id, $start_date, $end_date, $order);

        AjaxHelper::addResponse('html', '#search_results', view('categories._parts._search', compact('blogs'))->render());

        return AjaxHelper::endAjax();
    }
}

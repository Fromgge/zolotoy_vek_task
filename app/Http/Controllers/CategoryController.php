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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $categoryId = $request->input('category');
        $order = $request->input('order');

        $blogs = Blog::search($categoryId, $startDate, $endDate, $order);

        AjaxHelper::addResponse('html', '#search_results', view('categories._parts._search', compact('blogs'))->render());

        return AjaxHelper::endAjax();
    }
}

<?php

namespace App\Http\Controllers;

use App\Classes\AjaxHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BlogSearchService;

class CategoryController extends Controller
{
    protected $blogSearchService;

    public function __construct(BlogSearchService $blogSearchService)
    {
        $this->blogSearchService = $blogSearchService;
    }

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
        $blogs = $this->blogSearchService->search($request);

        AjaxHelper::addResponse('html', '#search_results', view('categories._parts._search', compact('blogs'))->render());

        return AjaxHelper::endAjax();
    }
}

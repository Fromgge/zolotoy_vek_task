<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->getAllBlogs();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:500'
            ]);

            $this->blogService->createBlog($request->all());

            return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating blog: ' . $e->getMessage());
        }
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        try {
            $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:500'
            ]);

            $this->blogService->updateBlog($blog, $request->all());

            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating blog: ' . $e->getMessage());
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $this->blogService->deleteBlog($blog);
            return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Error deleting blog: ' . $e->getMessage());
        }
    }
}

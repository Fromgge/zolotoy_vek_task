<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::all();
            return view('admin.blogs.index', compact('blogs'));
        } catch (\Exception $e) {
            Log::error('Error fetching blogs: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Error fetching blogs.');
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            return view('admin.blogs.create', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories for blog creation: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Error fetching categories for blog creation.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:500'
            ]);

            $blog = Blog::create($request->only('title', 'content'));

            if ($request->has('categories')) {
                $categories = Category::find($request->input('categories'));
                $blog->categories()->attach($categories);
            }

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
        try {
            $categories = Category::all();
            return view('admin.blogs.edit', compact('blog', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories for blog editing: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Error fetching categories for blog editing.');
        }
    }

    public function update(Request $request, Blog $blog)
    {
        try {
            $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:500'
            ]);

            $blog->update([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            $blog->categories()->sync($request->input('categories', []));

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
            $blog->delete();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Error deleting blog: ' . $e->getMessage());
        }
    }
}

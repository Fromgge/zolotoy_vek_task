<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return view('admin.categories.index', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Error fetching categories.');
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
            ]);

            Category::create($request->all());

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        } catch (ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Validation error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating category: ' . $e->getMessage());
        }

    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.show', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        } catch (\Exception $e) {
            Log::error('Error fetching category details: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Error fetching category details.');
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        } catch (\Exception $e) {
            Log::error('Error fetching category details: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Error fetching category details.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
            ]);

            $category = Category::findOrFail($id);
            $category->update($request->all());

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Validation error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found');
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}

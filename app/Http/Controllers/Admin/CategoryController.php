<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
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

            $this->categoryService->createCategory($request->all());

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
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
            ]);

            $category = $this->categoryService->getCategoryById($id);
            $this->categoryService->updateCategory($category, $request->all());

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
            $category = $this->categoryService->getCategoryById($id);
            $this->categoryService->deleteCategory($category);

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}

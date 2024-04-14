<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory(array $data)
    {
        try {
            return Category::create($data);
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            throw new \Exception('Error creating category');
        }
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Category $category, array $data)
    {
        try {
            $category->update($data);
            return $category;
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            throw new \Exception('Error updating category');
        }
    }

    public function deleteCategory(Category $category)
    {
        try {
            return $category->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            throw new \Exception('Error deleting category');
        }
    }
}

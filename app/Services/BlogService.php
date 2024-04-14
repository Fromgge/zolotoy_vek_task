<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class BlogService
{
    public function getAllBlogs()
    {
        return Blog::all();
    }

    public function createBlog(array $data)
    {
        try {
            $blog = Blog::create($data);

            if (isset($data['categories'])) {
                $categories = Category::find($data['categories']);
                $blog->categories()->attach($categories);
            }

            return $blog;
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            throw new \Exception('Error creating blog');
        }
    }

    public function getBlogById($id)
    {
        return Blog::findOrFail($id);
    }

    public function updateBlog(Blog $blog, array $data)
    {
        try {
            $blog->update($data);

            if (isset($data['categories'])) {
                $blog->categories()->sync($data['categories']);
            }

            return $blog;
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage());
            throw new \Exception('Error updating blog');
        }
    }

    public function deleteBlog(Blog $blog)
    {
        try {
            return $blog->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            throw new \Exception('Error deleting blog');
        }
    }
}

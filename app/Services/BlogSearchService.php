<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class BlogSearchService
{
    public function search(Request $request)
    {
        try {
            $categoryId = $request->input('category');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $order = $request->input('order');

            $blogs = Blog::search($categoryId, $startDate, $endDate, $order);

            return $blogs;
        } catch (QueryException $e) {
            Log::error('Error executing search query: ' . $e->getMessage());
            throw new \Exception('An error occurred while searching blogs.');
        }
    }
}

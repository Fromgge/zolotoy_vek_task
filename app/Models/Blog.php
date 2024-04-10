<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    protected $fillable = ['title', 'content'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blogs_categories');
    }


    public function search($category_id, $start_date = false, $end_date = false, $order = 'new')
    {
        $blogs = Blog::query()->whereHas('categories', function($query) use ($category_id) {
            $query->where('categories.id', $category_id);
        });

        if ($start_date && $end_date) {
            $blogs->whereBetween('blogs.created_at', [$start_date, $end_date]);
        }

        if ($order == 'new'){
            $blogs->orderBy('created_at', 'desc');
        } elseif ($order == 'old') {
            $blogs->orderBy('created_at', 'asc');
        }

        return $blogs->get();
    }

}

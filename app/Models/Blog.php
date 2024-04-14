<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blogs_categories');
    }


    public function search($categoryId, $startDate = false, $endDate = false, $order = 'new')
    {
        $blogs = Blog::query()->whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        });

        if ($startDate && $endDate) {
            $blogs->whereBetween('blogs.created_at', [$startDate, $endDate]);
        }

        if ($order == 'new') {
            $blogs->orderBy('created_at', 'desc');
        } elseif ($order == 'old') {
            $blogs->orderBy('created_at', 'asc');
        }

        return $blogs->get();
    }

}

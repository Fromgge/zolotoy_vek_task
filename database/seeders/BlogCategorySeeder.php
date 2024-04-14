<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory(50)->create();
        Category::factory(50)->create();

        $blogs = Blog::all();
        $categories = Category::all();

        foreach ($blogs as $blog) {
            $category = $categories->random();
            $blog->categories()->attach($category);
        }
    }
}

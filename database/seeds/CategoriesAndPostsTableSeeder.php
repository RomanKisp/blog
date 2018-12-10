<?php

use Illuminate\Database\Seeder;

class CategoriesAndPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$categories = factory(App\Category::class, 'categories', 3)->create();

		foreach ($categories as $category) {
			factory(App\Post::class, 'posts', 10)
				->create()
				->each(function ($post) use ($category) {
					$category->posts()->save($post);
	        	});
		}
    }
}

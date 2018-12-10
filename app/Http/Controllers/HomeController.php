<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\View;

class HomeController extends BaseController
{
	public $elements = []; 

    public function __construct() {
    	parent::__construct();
    	$this->getCategories();
    	$this->getPosts();
        $this->getPostsWithoutCategory();
    }

    public function index()
    {
        return View::make('home.index', ['elements' => $this->elements]);
    }

    public function getCategories()
    {
    	$categories = Category::orderBy('name')->get();
        $this->elements['categories'] = $categories;
    }

    public function getPosts()
    {
		$posts = Post::with('category')->orderBy('created_at', 'desc')->paginate(10);
        $this->elements['posts'] = $posts;
    }

    public function getPostsWithoutCategory()
    {
        $posts_without_category = Post::where('category_id', null)
        ->orderBy('created_at', 'desc')->count();
        $this->elements['posts_without_category'] = $posts_without_category;
    }
}

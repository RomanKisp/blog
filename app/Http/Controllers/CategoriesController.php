<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{

    public function __construct() {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable|string',
        ]);

        $category = new Category($request->all());
        $category->save();

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::
        with(array('attachableComments' => function($query) 
        {
            $query->orderBy('created_at', 'desc');
        }))
        ->where('id', $id)->first();

        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(10);

        return view('categories.show', ['category' => $category, 'posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();

        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable|string',
        ]);

        $category = Category::where('id', $id)->first();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect('/categories/'.$category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        $posts = Post::where('category_id', $id)->get();

        foreach ($posts as $post) {
            $post->category()->dissociate();
            $post->save();
        }

        $category->attachableComments()->delete();
        $category->delete();

        return redirect('/');
    }
}

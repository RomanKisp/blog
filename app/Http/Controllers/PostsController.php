<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends BaseController
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
        $categories = Category::orderBy('name')->get();

        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::pluck('id');
        $category = implode(",", $category->all());

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|integer|in:'.$category,
            'file' => 'nullable|max:2000',
        ]);

        $post = new Post;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        if ($request->hasFile('file')) {
            $this->saveFile($request->file, $post);
        }

        return redirect('/posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::
        with(array('attachableComments' => function($query) 
        {
            $query->orderBy('created_at', 'desc');
        }))
        ->with('category', 'files')
        ->where('id', $id)->first();

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $post = Post::with('category', 'files')->where('id', $id)->first();

        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
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
        $category = Category::pluck('id');
        $category = implode(",", $category->all());
   
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|integer|in:'.$category,
            'file' => 'nullable|max:2000',
        ]);

        $post = Post::where('id', $id)->first();
        $post->name = $request->name;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        if ($request->hasFile('file')) {
            $file = File::where('post_id', $post->id)->first();
            if ($file) {
                Storage::disk('public')->delete($file->path);
                $file->delete();
            }
            $this->saveFile($request->file, $post);
        }

        return redirect('/posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        if ($post->files) {
            Storage::disk('public')->deleteDirectory('posts_files/'.$post->name.'_'.$post->id);
            $post->files()->delete();
        }
        $post->attachableComments()->delete();
        $post->delete();

        return redirect('/');
    }

    public function postsWithoutCategory()
    {
        $posts = Post::where('category_id', null)
        ->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.without_category', ['posts' => $posts]);
    }

    public function saveFile($new_file, $post)
    {
        $path = $new_file->store(
            'posts_files/'.$post->name.'_'.$post->id, 'public'
        );

        $file = new File;
        $file->name = $new_file->getClientOriginalName();
        $file->file_size = $new_file->getSize();
        $file->post_id = $post->id;
        $file->path = $path;
        $file->save();
    }
}

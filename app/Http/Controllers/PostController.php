<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    protected $limit = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\DB::enableQueryLog();
        $posts = Post::latestFirst()
            ->published()
            ->filter(request()->only(['term', 'year', 'month']))
            ->simplePaginate($this->limit);

        
        //$posts = Post::with('author')->get();

        //dd( $posts);
        
        return view('blog.index', compact('posts'));
        //dd(\DB::getQueryLog());
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;

        //\DB::enableQueryLog();
        $posts = $category
            ->posts()
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
       
        //dd( $posts);
        
        return view('blog.index', compact('posts',  'categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->title;

        //\DB::enableQueryLog();
        $posts = $tag
            ->posts()
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
       
        //dd( $posts);
        
        return view('blog.index', compact('posts',  'tagName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
      
        //\DB::enableQueryLog();
        $posts = $author->posts()
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);
       
        //dd( $posts);
        
        return view('blog.index', compact('posts',  'authorName'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('view_count');

        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

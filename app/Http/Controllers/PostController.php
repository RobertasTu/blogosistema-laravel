<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Sortable;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        $categories = Category::all();

        // $filterCategories = $categories;
        $filterCategory = $request->filterCategory;
        $filterPosts = $posts;

        if(!$filterCategory || $filterCategory == 'all') {
            $posts = Post::sortable()->paginate(20);

        } else {

            $posts = Post::query()->where('category_id', $filterCategory)->sortable()->paginate(20);

        }
    return view('post.index', ['posts'=>$posts, 'categories'=>$categories, 'filterPosts'=>$filterPosts, 'filterCategory'=>$filterCategory] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryNew = $request->categoryNew;
        if($categoryNew == '1') {
            $category = new Category;
            $category->title = $request->category_title;
            $category->excerpt = $request->category_excerpt;
            $category->description = $request->category_description;
            $category->save();

            $category_id = $category->id;
        } else {
            $category_id =$request->post_category_id;
        }
        // $categories = Category::all();
        $post = new Post;
        $post->title = $request->post_title;
        $post->excerpt = $request->post_excerpt;
        $post->description = $request->post_description;
         $post->category_id = $category_id;

        if($request->has('post_picture')) {
            $imageName = '/images/'.time().'.'.$request->post_picture->extension();
           $post->picture = '/images/'.time().'.'.$request->post_picture->extension();
           $request->post_picture->move(public_path('images'), $imageName );
           } else {
           $post->picture = '/images/placeholder.png';
           }

        $post->save();

        return redirect()->route("post.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', ['post'=>$post, 'categories'=>$categories]);
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
        $post->title = $request->post_title;
        $post->excerpt = $request->post_excerpt;
        $post->description = $request->post_description;
        $post->category_id = $request->post_category_id;

        if($request->has('post_picture')) {
            $imageName = '/images/'.time().'.'.$request->post_picture->extension();
           $post->picture =  '/images/'.time().'.'.$request->post_picture->extension();
           $request->post_picture->move(public_path('/images/'), $imageName );
           }


        $post->save();

        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.index');
    }

    public function destroyAjax(Post $post)
    {
        $category_id = $post->category_id;
        $post->delete();
        $postsLeft = Post::where('category_id', $category_id)->get();
        $postsCount = $postsLeft->count();

        //sekmes nesekmes zinute
        $success = [
            "success" => "The post has been deleted",
            "postsCount" => $postsCount
        ];
        $success_json = response()->json($success);

        return $success_json;

    }
}

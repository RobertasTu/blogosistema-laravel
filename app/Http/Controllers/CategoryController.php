<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Sortable;
use App\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Category::sortable()->get();
        $posts = Post::all();

        return view('category.index', ['categories'=>$categories, 'posts'=>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postsNew = $request->postsNew;

        $category = new Category;

        $category->title = $request->category_title;
        $category->excerpt = $request->category_excerpt;
        $category->description = $request->category_description;

        $category->save();


        $postsInputCount = count($request->postTitle);

        if($postsNew == '1') {
            for($i = 0; $i < $postsInputCount; $i++) {



                $post = new Post;
                $post->title = $request->postTitle[$i];
                $post->excerpt = $request->postExcerpt[$i];
                $post->description = $request->postDescription[$i];
                $post->category_id = $category->id;


                // $post->picture = $request->postPicture[$i];

                // kategorija ir 2 post
                // 1 post turi paveiksliuka
                // 2 post neutri paveiksliuko
                // 3 post turi
                //4 post neturi
                // postPictures = [
                    // 0 => 'qwertyuiophasdfghsd',
                    // 1 => '',
                    // 2 => 'kadfhadskjfksdflksj',
                    // 3 => ''
                // ]


                if(!empty($request->postPicture[$i])) {



                    $imageName = '/images/'. $i.time().'.'.$request->postPicture[$i]->extension();
                   $post->picture =  time().'.'.$request->postPicture[$i]->extension();
                   $request->postPicture[$i]->move(public_path('images'), $imageName );
                   } else {
                   $post->picture = '/images/placeholder.png';
                   }
                $post->save();
            }
        }

        return redirect()->route("category.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categoryPostsCount = $category->categoryPosts->count();
        $posts = $category->categoryPosts;
        $postsCount = $posts->count();
        $posts = $category->categoryPosts;
        return view('category.show', ['category'=>$category, 'postsCount'=>$postsCount, 'posts'=>$posts, 'categoryPostsCount'=>$categoryPostsCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->category_title;
        $category->excerpt = $request->category_excerpt;
        $category->description = $request->category_description;

        $category->save();

        return redirect()->route("category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $categoryPostsCount = $category->categoryPosts->count();

        if($categoryPostsCount == 0 ) {
        $category->delete();
        } else {
        return redirect()->route("category.index")->with('error_messages', 'Category has posts');
        }
        return redirect()->route("category.index")->with('success_message', 'Category deleted, you lucky son of gun');
    }

}

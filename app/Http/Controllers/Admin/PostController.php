<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $validationRules = [
        'title' => 'required|min:3|max:255',
        'post_content' => 'required|min:5',
        'post_image' => 'active_url',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post = new Post;
        $categories = Category::all();
        return view('admin.posts.create', ['post' => $post, 'categories' => $categories]);
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
        $data = $request->all();
        // dd($data);
        $validatedData = $request->validate($this->validationRules);

        $newPost = new Post;
        $newPost->user_id = Auth::id();
        $newPost->title = $data['title']; 
        $newPost->post_content = $data['post_content']; 
        $newPost->post_image = $data['post_image']; 
        $newPost->post_date = new DateTime(); 
        $newPost->save(); 

        return redirect()->route('admin.posts.index')->with('result-message', '"'.$newPost['title'].'"'.'Post Created')->with('result-class-message','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
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
        //
        $data = $request->all();
        
        $validatedData = $request->validate($this->validationRules);

        $newPost = Post::findOrFail($id);
        
        $newPost->update($data); 

        return redirect()->route('admin.posts.index', $newPost->id)->with('result-message', '"'.$newPost->title.'"'.'Post Edited')->with('result-class-message','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('result-message', '"'.$post->title.'"'.'Post Deleted')->with('result-class-message','danger');
    }
}

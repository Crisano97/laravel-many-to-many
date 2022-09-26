<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validationRules = [
        'title' => 'required|min:3|max:255',
        'post_content' => 'required|min:5',
        'post_image' => 'image|max:256',
        'category_id' => 'nullable|exists:categories,id',
        'tags' => 'exists:tags,id',

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
        $tags = Tag::all();
        return view('admin.posts.create', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
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
        // $newPost->title = $data['title']; 
        // $newPost->post_content = $data['post_content']; 
        // $newPost->post_image = $data['post_image']; 
        // $newPost->post_date = new DateTime(); 
        // $newPost->category_id = $data['category_id'];
        $data['user_id'] = Auth::id();
        $data['post_date'] = new DateTime();
        $data['post_image'] = Storage::put('uploads', $data['post_image']);
        $newPost->fill($data);
        $newPost->save(); 
        if (array_key_exists('tag', $data)) {
            $newPost->tags()->sync($data['tags']);
        }

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
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
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
        // dd($data);
        
        $validatedData = $request->validate($this->validationRules);
        $data['post_image'] = Storage::put('uploads', $data['post_image']);
        $newPost = Post::findOrFail($id);
        
        $newPost->update($data); 
        if(array_key_exists('tags', $data)){
            $newPost->tags()->sync($data['tags']);
        } else {
            $newPost->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $newPost->id)->with('result-message', '"'.$newPost->title.'"'.'Post Edited')->with('result-class-message','success');
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

    public function removePostFromCategory ($id)
    {
        $post = Post::findOrFail($id);
        $category_id = $post->category_id;
        $post->category_id = null;
        $post->save();
        return redirect()->route('admin.categories.show', $category_id);
    }
}

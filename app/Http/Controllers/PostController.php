<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create','store']);   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // upload the image to storage
        
        $image = $request->image->store('posts');
        
        //create the posts

        $post = Post::create([
                    'title'       => $request->title,
                    'description' => $request->description,
                    'content'     => $request->content,
                    'image'       => $image,
                    'published_at'=> $request->published_at,
                    'category_id' => $request->category,
                    'user_id'     => auth()->user()->id,
                ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        
        // Flash Message
        session()->flash('success','Post created successfully.');

        //Redirect user

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','published_at', 'content']);
        // chef if new image
        if($request->hasFile('image')){
            // upload it
            $image = $request->image->store('posts');
            // delete old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        
        //update attributes
        $post->update($data);

        // Flash Message
        session()->flash('success','Post updated successfully.');

        //Redirect user

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }

        $post->delete();

        // Flash Message
        session()->flash('success','Post deleted successfully.');

        //Redirect user

        return redirect(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    /**
     * Restored posts.
     *
     * @return restored
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();

        // Flash Message
        session()->flash('success','Post restored successfully.');

        return redirect()->back();
    }
}

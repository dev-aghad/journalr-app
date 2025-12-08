<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tag = $request->query('tag');

        if ($tag) {
            $posts = Post::whereHas('tags', function ($query) use ($tag) {
                $query->where('id', $tag);
            })->get();
        } else {
            $posts = Post::get();
        }

        $tags = Tag::all();

        return view('posts.index', ['posts'=>$posts, 
            'tags'=>$tags,'tag'=>$tag,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'string|required|max:60',
            'body' => 'string|required|max:20000',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->user_id = auth()->id();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post_images', 'public');
            $post->image_path = $path;
        }   
        
        $post->save();
        
        session()->flash('message', 'Post successfully created.');
        return redirect()->route('posts.index', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'title' => 'string|required|max:60',
            'body'  => 'string|required|max:20000',
        ]);

        $post->title = $validatedData['title'];
        $post->body  = $validatedData['body'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post_images', 'public');
            $post->image_path = $path;
        }

        $post->save();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}

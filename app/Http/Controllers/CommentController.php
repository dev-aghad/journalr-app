<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Mail\CommentOnPostMail;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required|string',
        ]);

        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;

        $comment->save();

        $postOwner = $post->user;

        if ($postOwner && $postOwner->email_verified_at) {
        Mail::to($postOwner->email)->send(
            new CommentOnPostMail($post, $comment)
        );
    }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment successfully deleted');
    }
}

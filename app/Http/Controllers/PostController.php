<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'heading' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required',
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->category_id = $request->category_id;
        $post->heading = $request->heading;
        $post->slug = Str::slug($request->heading);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->description = $request->description;
        $post->save();

        // Attach tags (Create new ones if they don't exist)
        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)], ['slug' => Str::slug(trim($tagName))]);
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category', 'tags');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'heading' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required',
        ]);

        $post->category_id = $request->category_id;
        $post->heading = $request->heading;
        $post->slug = Str::slug($request->heading);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->description = $request->description;
        $post->save();

        // Attach updated tags
        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)], ['slug' => Str::slug(trim($tagName))]);
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

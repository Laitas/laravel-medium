<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Likes;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $category)
    {

        if (!$category) {
            return view('dashboard', ['categories' => Category::get(), 'posts' => Post::paginate(10)]);
        }
        $category_id = Category::where('name', $category)->value('id');
        return view('dashboard', ['categories' => Category::get(), 'posts' => Post::where('category_id', $category_id)->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|datetime'
        ]);

        $image = $data['image'];
        unset($data['image']);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);
        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        Post::create($data);

        return redirect()->route('posts.show', ['username' => Auth::user()->username, 'slug' => $data['slug']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $username, String $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = $request->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            Likes::destroy(['user_id' => $user->id, 'post_id' => $post->id]);
            $liked = false;
        } else {
            Likes::create(['user_id' => $user->id, 'post_id' => $post->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likes()->count()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        if (!Auth::user()->tokenCan('post:read')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $posts = Post::with('user')->latest()->get();
        return response()->json($posts);
    }

    public function store(Request $request): JsonResponse
    {
        if (!Auth::user()->tokenCan('post:create')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Auth::user()->posts()->create($validated);

        return response()->json($post, 201);
    }

    public function show(Post $post): JsonResponse
    {
        if (!Auth::user()->tokenCan('post:read')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($post->load('user'));
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        if (!Auth::user()->tokenCan('post:update')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        if (!Auth::user()->tokenCan('*') && !Auth::user()->tokenCan('post:delete')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(null, 204);
    }
}

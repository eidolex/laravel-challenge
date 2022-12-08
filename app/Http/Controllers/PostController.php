<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostReactionRequest;
use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::query()
            ->with(['tags'])
            ->withCount('likes')
            ->get();

        return PostResource::collection($posts);
    }

    public function toggleReaction(PostReactionRequest $request)
    {
        $request->validate([
            'post_id' => 'required|int|exists:posts,id',
            'like'   => 'required|boolean'
        ]);

        $post = Post::find($request->post_id);

        // not need this code block as it's already in validation
        // if(!$post) {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'model not found'
        //     ]);
        // }

        $authId = auth()->id();

        // can move to validation but I don't as status is different
        if ($post->user_id == $authId) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post'
            ]);
        }

        // did we need to care about this part?
        // $like = Like::query()
        //     ->where('post_id', $request->post_id)
        //     ->where('user_id', $authId)
        //     ->first();

        // if($like && $request->like) {
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'You already liked this post'
        //     ]);
        // }

        if (!$request->like) {
            Like::query()
                ->where('post_id', $request->post_id)
                ->where('user_id', $authId)
                ->delete();

            return response()->json([
                'status' => 200,
                'message' => 'You unlike this post successfully'
            ]);
        }

        Like::firstOrCreate([
            'post_id' => $request->post_id,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'You like this post successfully'
        ]);
    }
}

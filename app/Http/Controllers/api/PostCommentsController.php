<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCommentsResource;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function showAllComments(Request $request)
    {
        $request_data = $request->all()['post_id'];
        $comments = PostComment::where('post_id', $request_data)->get();

        return PostCommentsResource::collection($comments);
    }

    public function commentCreate(Request $request)
    {
        $request_data = $request->all();
        $comment = PostComment::create([
            'name' => $request_data['name'],
            'comment' => $request_data['comment'],
            'post_id' => $request_data['post_id'],
            'parent_id' => $request_data['parent_id']
        ]);

        return new PostCommentsResource($comment);
    }

    public function commentUpdate(Request $request)
    {
        $request_data = $request->all();
        $comment = PostComment::updateOrCreate(
            [
                'post_id' => $request_data['post_id'],
                'id' => $request_data['id']
            ],
            [
                'name' => $request_data['name'],
                'comment' => $request_data['comment'],
            ]
        );

        return new PostCommentsResource($comment);
    }

    public function commentDelete(Request $request)
    {
        $request_data = $request->all();
        PostComment::where('id', $request_data['id'])
            ->where('post_id', $request_data['post_id'])
            ->delete();

        $comments = PostComment::where('post_id', $request_data['post_id'])->get();
        return PostCommentsResource::collection($comments);
    }
}

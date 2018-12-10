<?php

namespace App\Http\Controllers;

use Validator;
use App\Comment;
use App\Rules\AuthorCommentRule;
use App\Rules\AttachableCommentRule;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => [
                'required',
                new AuthorCommentRule()
            ],
            'comment' => 'required',
            'attachable_id' => 'integer|required',
            'attachable_type' => [
                'required',
                new AttachableCommentRule($request->attachable_id)
            ],
        ]);

        if ($validator->fails()) {
            $view_error = view('layout.components.errors')->withErrors($validator)->render();

            return response()->json([
                'error' => TRUE, 
                'html_error' => $view_error
            ]);
        }

    	$comment = new Comment($request->all());
        $author = trim($request->author);
        $comment->author = mb_convert_case($author, MB_CASE_TITLE, "UTF-8");
        $comment->save();

        $view_comment = view('layout.components.comment', ['comment' => $comment])->render();

        return response()->json([
            'success' => TRUE, 
            'html_comment' => $view_comment
        ]);
    }
}

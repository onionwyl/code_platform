<?php

namespace App\Http\Controllers;

use View;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

use App\User;
use App\UserInfo;
use App\Repository;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'content' => 'required'
            ]);
        }
        return Redirect::back();
    }

    public function replyComment(Request $request)
    {
        if($request->method() == "POST")
        {

        }
        return Redirect::back();
    }
 
    public function deleteComment(Request $request, $comment_id)
    {
        $uid = $request->session()->get('uid');
        $commentObj = Comment::where(['uid' => $uid, 'comid' => $comment_id]);
        if($commentObj == NULL)
            return Redirect::back();
        $commentObj->delete();
        return Redirect::back();
    }
}

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
    public function showComment(Request $request, $username, $repo_name)
    {
        $data = [];
        $userObj = User::where('username', $username)->first();
        if($userObj == NULL)
            return Redirect::to('/');
        $userInfoObj = UserInfo::where('uid', $userObj->uid)->first();
        $repoObj = Repository::where(['uid' => $userObj->uid, 'repo_name' => $repo_name])->first();
        if($repoObj == NULL)
            return Redirect::to('/');
        $commentObj = Comment::where(['repoid' => $repoObj->rid])->orderby('floor', 'asc')->get();
        for($i = 0; $i < $commentObj->count(); $i++)
        {
            if(($nickname = Userinfo::where('uid', $commentObj[$i]->uid)->first()->nickname) != "")
                $commentObj[$i]->name = $nickname;
            else
                $commentObj[$i]->name = User::where('uid', $commentObj[$i]->uid)->first()->username;
        }
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        $data['repo'] = $repoObj;
        $data['comments'] = $commentObj;
        return View::make('repository.comment')->with($data);
    }

    public function addComment(Request $request)
    {
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'comment' => 'required'
            ]);
            $input = $request->input();
            $repoObj = Repository::where('rid', $input['repoid'])->first();
            if(isset($input['repoid']) && $repoObj != NULL)
            {
                $commentObj = new Comment;
                $commentObj->repoid = $input['repoid'];
                $commentObj->uid = $request->session()->get('uid');
                if(Comment::where('repoid', $input['repoid'])->get()->count() == 0)
                    $commentObj->floor = 1;
                else
                    $commentObj->floor = Comment::where('repoid', $input['repoid'])->orderby('floor', 'asc')->get()->last()->floor+1;
                $commentObj->username = $request->session()->get('username');
                $commentObj->replyto = 0;
                $commentObj->content = $input['comment'];
                $commentObj->save();
                $repo_name = $repoObj->repo_name;
                $username = User::where('uid', $repoObj->uid)->first()->username;
                return Redirect::to("/comment/$username/repository/$repo_name");
            }
        }
        return Redirect::back();
    }

    public function replyComment(Request $request)
    {
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'comment' => 'required'
            ]);
            $input = $request->input();
            $repoObj = Repository::where('rid', $input['repoid'])->first();
            if(isset($input['repoid']) && $repoObj != NULL)
            {
                $commentObj = new Comment;
                $commentObj->repoid = $input['repoid'];
                $commentObj->uid = $request->session()->get('uid');
                if(Comment::where('repoid', $input['repoid'])->get()->count() == 0)
                    $commentObj->floor = 1;
                else
                    $commentObj->floor = Comment::where('repoid', $input['repoid'])->orderby('floor', 'asc')->get()->last()->floor+1;
                $commentObj->username = $request->session()->get('username');
                $commentObj->replyto = $input['replyto'];
                $commentObj->content = $input['comment'];
                $commentObj->save();
                $repo_name = $repoObj->repo_name;
                $username = User::where('uid', $repoObj->uid)->first()->username;
                return Redirect::to("/comment/$username/repository/$repo_name");
            }
        }
        return Redirect::back();
    }
 
    public function deleteComment(Request $request, $comment_id)
    {
        $tmpuid = $request->session()->get('uid');
        $uid = $request->input('uid');
        if($tmpuid != $uid && User::where('uid', $tmpuid)->first()->gid != 0)
            return Redirect::back();
        $commentObj = Comment::where(['uid' => $uid, 'comid' => $comment_id]);
        if($commentObj == NULL)
            return Redirect::back();
        $commentObj->delete();
        return Redirect::back();
    }
}

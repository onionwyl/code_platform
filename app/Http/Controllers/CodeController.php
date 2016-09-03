<?php

namespace App\Http\Controllers;

use View;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

use App\User;
use App\UserInfo;
use App\Repository;
use App\Category;
use App\Code;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function showCode(Request $request, $username, $repo_name, $file_name)
    {
        $data = [];
        $tmpuid = $request->session()->get('uid');
        $data['tmpuid'] = $tmpuid;
        $userObj = User::where('username', $username)->first();
        if($userObj != NULL)
        {
            $uid = $userObj->uid;
            $userInfoObj = UserInfo::where('uid', $uid)->first();
            $repoObj = Repository::where(['uid' => $uid, 'repo_name' => $repo_name])->first();
            if($repoObj != NULL)
            {
                $codeObj = Code::where(['uid' => $uid, 'rid' => $repoObj->rid, 'file_name' => $file_name])->first();
                if($codeObj != NULL)
                {
                    $data['user'] = $userObj;
                    $data['userinfo'] = $userInfoObj;
                    $data['repo'] = $repoObj;
                    $data['code'] = $codeObj;
                    return View::make('code.index')->with($data);
                }
            }
        }
        return Redirect::to('/');
    }

    public function addCode(Request $request, $username, $repo_name)
    {
        $data = [];
        $errMsg = new MessageBag;
        $tmpuid = $request->session()->get('uid');
        $data['tmpuid'] = $tmpuid;
        $userObj = User::where('username', $username)->first();
        if($userObj == NULL)
        {
            return Redirect::to('/');
        }
        $uid = $userObj->uid;
        if($uid != $tmpuid)
        {
            return Redirect::to('/');
        }
        $userInfoObj = UserInfo::where('uid', $uid)->first();
        $repoObj = Repository::where(['uid' => $uid, 'repo_name' => $repo_name])->first();
        if($repoObj == NULL)
        {
            return Redirect::to('/');
        }
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        $data['repo'] = $repoObj;
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'file_name' => 'required|unique:code,file_name,NULL,cid,uid,'.$uid.',rid,'.$repoObj->rid
            ]);
            $input = $request->input();
            $codeObj = new Code;
            $codeObj->rid = $repoObj->rid;
            $codeObj->uid = $uid;
            $codeObj->file_name = $input['file_name'];
            $codeObj->content = $input['code'];
            $codeObj->description = $input['description'];
            $repoObj->update_time = date('Y-m-d h:i:s');
            $codeObj->save();
            $repoObj->save();
            return Redirect::to("/$userObj->username/repository/$repoObj->repo_name/$codeObj->file_name");
        }
        return View::make('code.add')->with($data);
    }

    public function editCode(Request $request, $username, $repo_name, $file_name)
    {
        if($file_name == "")
        {
            return Redirect::to('/');
        }
        $data = [];
        $errMsg = new MessageBag;
        $tmpuid = $request->session()->get('uid');
        $data['tmpuid'] = $tmpuid;
        $userObj = User::where('username', $username)->first();
        if($userObj == NULL)
        {
            return Redirect::to('/');
        }
        $uid = $userObj->uid;
        if($uid != $tmpuid)
        {
            return Redirect::to('/');
        }
        $userInfoObj = UserInfo::where('uid', $uid)->first();
        $repoObj = Repository::where(['uid' => $uid, 'repo_name' => $repo_name])->first();
        if($repoObj == NULL)
        {
            return Redirect::to('/');
        }
        $codeObj = Code::where(['uid' => $uid, 'rid' => $repoObj->rid, 'file_name' => $file_name])->first();
        if($codeObj == NULL)
        {
            return Redirect::to('/');   
        }
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        $data['repo'] = $repoObj;
        $data['code'] = $codeObj;
        if($request->method() == "POST")
        {
            $input = $request->input();
            $this->validate($request, [
                'file_name' => 'required|unique:code,file_name,'.$codeObj->cid.',cid,uid,'.$uid.',rid,'.$repoObj->rid
            ]);
            $codeObj->file_name = $input['file_name'];
            $codeObj->content = $input['code'];
            $codeObj->description = $input['description'];
            $repoObj->update_time = date('Y-m-d h:i:s');
            $codeObj->save();
            $repoObj->save();
            return Redirect::to("/$userObj->username/repository/$repoObj->repo_name/$codeObj->file_name");
        }
        return View::make('code.edit')->with($data);
    }

}

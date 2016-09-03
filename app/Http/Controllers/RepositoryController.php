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

class RepositoryController extends Controller
{
    public function addRepository(Request $request)
    {
        $data = [];
        $errMsg = new MessageBag;
        $data['category'] = Category::all();
        if($request->method() == "POST")
        {
            $input = $request->input();
            $uid = $request->session()->get('uid');
            $this->validate($request, [
                'repo_name' => 'required|max:255',
                'repo_description' => 'max:255'
            ]);
            if(Repository::where(['uid' => $uid, 'repo_name' => $input['repo_name']])->get()->count() > 0)
            {
                $errMsg->add('nameErr', 'Repo name exists');
                return Redirect::to('/new')->withErrors($errMsg);
            }
            $repoObj = new Repository;
            $repoObj->uid = $uid;
            $repoObj->repo_name = $input['repo_name'];
            $repoObj->catid = $input['type'];
            $repoObj->repo_description = $input['repo_description'];
            $repoObj->update_time = date('Y-m-d h:i:s');
            $repoObj->save();
            $username = $request->session()->get('username');
            return Redirect::to("/$username/repository/$repoObj->repo_name");
        }
        return View::make('repository.add')->with($data);
    }

    public function showUserRepos(Request $request, $username)
    {
        $data = [];
        $tmpuid = $request->session()->get('uid');
        $data['tmpuid'] = $tmpuid;
        $userObj = User::where('username', $username)->first();
        if($userObj != NULL)
        {
            $uid = $userObj->uid;
            $userInfoObj = UserInfo::where('uid', $uid)->first();
            $repoObj = Repository::where('uid', $uid)->get();
            if($repoObj != NULL)
            {
                $catObj = Category::all();
                $data['user'] = $userObj;
                $data['userinfo'] = $userInfoObj;
                $data['repo'] = $repoObj;
                $data['cat'] = $catObj;
                return View::make('repository.list')->with($data);
            }
        }
        return Redirect::to('/');
    }

    public function showRepo(Request $request, $username, $repo_name)
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
                $codeObj = Code::where('rid', $repoObj->rid)->get();
                $catObj = Category::where('catid', $repoObj->catid)->first();
                $data['user'] = $userObj;
                $data['userinfo'] = $userInfoObj;
                $data['repo'] = $repoObj;
                $data['code'] = $codeObj;
                $data['cat'] = $catObj;
                return View::make('repository.index')->with($data);
            }
        }
        return Redirect::to('/');
    }

    public function showDashboardRepo(Request $request)
    {
        $data = [];
        $uid = $request->session()->get('uid');
        $userObj = User::where('uid', $uid)->first();
        $userInfoObj = UserInfo::where('uid', $uid)->first();
        $repoObj = Repository::where('uid', $uid)->get();
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        $data['repo'] = $repoObj;
        return View::make('dashboard.repository')->with($data);
    }

    public function deleteRepo(Request $request, $repo_name)
    {
        $uid = $request->session()->get('uid');
        $repoObj = Repository::where(['uid' => $uid, 'repo_name' => $repo_name])->first();
        if($repoObj != NULL)
        {
            Code::where(['uid' => $uid, 'rid' => $repoObj->rid])->delete();
            $repoObj->delete();
        }
        return Redirect::to('/dashboard/repository');
    }

    public function editRepo(Request $request, $repo_name)
    {
        $data = [];
        $input = $request->input();
        $uid = $request->session()->get('uid');
        $repoObj = Repository::where(['uid' => $uid, 'repo_name' => $repo_name])->first();
        if($repoObj == NULL)
        {
            return Redirect::to('/dashboard/repository');
        }
        $data['category'] = Category::all();
        $data['repo'] = $repoObj;
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'repo_name' => 'required|max:255|unique:repository,repo_name,'.$repoObj->rid.',rid',
                'repo_description' => 'max:255'
            ]);
            $repoObj->repo_name = $input['repo_name'];
            $repoObj->repo_description = $input['repo_description'];
            $repoObj->catid = $input['type'];
            $repoObj->update_time = date('Y-m-d h:i:s');
            $repoObj->save();
            $username = $request->session()->get('username');
            return Redirect::to("/$username/repository/$repoObj->repo_name");
        }
        return View::make('repository.edit')->with($data);
    }

    public function showRepos(Request $request)
    {
        $data = [];
        $repoObj = Repository::all();
        for($i = 0; $i < $repoObj->count(); $i++)
        {
            $repoObj[$i]->username = User::where('uid', $repoObj[$i]->uid)->first()->username;
        }
        $data['repos'] = $repoObj;
        return View::make('repository.repos')->with($data);
    }

}

<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;

use App\User;
use App\UserInfo;
use App\Repository;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndex(Request $request)
    {
        $data = [];
        if($request->session()->has('uid'))
        {
            $uid = $request->session()->get('uid');
            $userObj = User::where('uid', $uid)->first();
            $userInfoObj = UserInfo::where('uid', $uid)->first();
            $userRepoObj = Repository::where('uid', $uid)->get();
            $userCatObj = Category::all();
            for($i = 0; $i < $userCatObj->count(); $i++)
            {
                $userCatObj[$i]->count = Repository::select('rid')->where(['uid' => $uid, 'catid' => $userCatObj[$i]->catid])->get()->count();
            }
        }
        $repoObj = Repository::all();
        for($i = 0; $i < $repoObj->count(); $i++)
        {
            $repoObj[$i]->username = User::where('uid', $repoObj[$i]->uid)->first()->username;
        }
        $categoryObj = Category::all();
        for($i = 0; $i < $categoryObj->count(); $i++)
        {
            $categoryObj[$i]->count = Repository::select('rid')->where('catid', $categoryObj[$i]->catid)->get()->count();
        }
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        $data['userrepo'] = $userRepoObj;
        $data['usercat'] = $userCatObj;
        $data['repos'] = $repoObj;
        $data['cats'] = $categoryObj;
        return View::make("home.index")->with($data);
    }

}

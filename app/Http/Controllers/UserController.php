<?php

namespace App\Http\Controllers;

use View;
use Hash;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

use App\User;
use App\UserInfo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function registerAction(Request $request)
    {
        $data = [];
        $input = $request->input();
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'username' => 'required|unique:users',
                'password' => 'required',
                'email' => 'required|unique:users'
            ]);
            $userObject = new User;
            $userObject->username = $input['username'];
            $userObject->password = Hash::make($input['password']);
            $userObject->email = $input['email'];
            $userObject->registration_time = date("Y-m-d h:i:s");
            $userObject->registration_ip = $request->ip();
            $userObject->lastlogin_ip = $request->ip();
            $userObject->gid = 1;
            $userObject->save();
            $userObject=User::where('username',$request->username)->first();
            $request->session()->put([
                "username" => $userObject->username,
                "uid" => $userObject->uid
            ]);
            $userInfoObj = new UserInfo;
            $userInfoObj->uid = $userObject->uid;
            $userInfoObj->save();
            return Redirect::to("/");

        }
        return View::make("auth.signup");
    }

    public function loginAction(Request $request)
    {
        $data = [];
        $input = $request->input();
        $errMsg = new MessageBag;
        if($request->method() == "POST")
        {
            $this->validate($request,[
                'username' => 'required',
                'password' => 'required'
            ]);
            $username = $input['username'];
            $password = $input['password'];
            $userObj = User::where('username', $username)->first();
            echo $username;
            if(isset($userObj))
            {
                if(Hash::check($password, $userObj->password))
                {
                    $request->session()->put([
                        "username" => $userObj->username,
                        "uid" => $userObj->uid
                    ]);
                    $userObj->where('uid', $userObj->uid)->update([
                        'lastlogin_ip' => $request->ip(),
                        'lastlogin_time' => date('Y-m-d h:i:s')
                    ]);
                    if($request->session()->get('lastUrl')!=NULL)
                        return Redirect::to($request->session()->get('lastUrl'));
                    return Redirect::to("/");
                }
                else
                {
                    $errMsg->add('passwdErr', 'Invalid Password!');
                }
            }
            else
            {
                $errMsg->add('usernameErr', 'No such user!');
            }
        }
        return View::make("auth.signin")->withErrors($errMsg);
    }

    public function showUserDashboard(Request $request)
    {
        $data = [];
        $uid = $request->session()->get('uid');
        $userObj = User::where('uid', $uid)->first();
        $data['user'] = $userObj;
        return View::make('user.dashboard')->with($data);
    }

}



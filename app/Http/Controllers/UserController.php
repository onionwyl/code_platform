<?php

namespace App\Http\Controllers;

use View;
use Hash;
use Mail;
use Redirect;
use Socialite;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\User;
use App\UserInfo;
use App\Repository;
use App\Category;
use App\PasswordReset;
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
                'username' => 'required|unique:users|between:5,255',
                'password' => 'required|between:5,255|confirmed',
                'email' => 'required|email|unique:users'
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
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
            $username = $input['username'];
            $password = $input['password'];
            $userObj = User::where('username', $username)->first();
            if(isset($userObj))
            {
                if(Hash::check($password, $userObj->password))
                {
                    $request->session()->put([
                        "username" => $userObj->username,
                        "uid" => $userObj->uid
                    ]);
                    if($userObj->gid == 0)
                    {
                        $request->session()->put([
                        "gid" => $userObj->gid,
                    ]);
                    }
                    $userObj->where('uid', $userObj->uid)->update([
                        'lastlogin_ip' => $request->ip(),
                        'lastlogin_time' => date('Y-m-d H:i:s')
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

    public function setUserProfile(Request $request)
    {
        $data = [];
        $errMsg = new MessageBag;
        $uid = $request->session()->get('uid');
        $userObj = User::where('uid', $uid)->first();
        $userInfoObj = UserInfo::where('uid', $uid)->first();
        $data['user'] = $userObj;
        $data['userinfo'] = $userInfoObj;
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,'.$userObj->uid.',uid',
                'nickname' => 'required|unique:userinfo,nickname,'.$userInfoObj->infoid.',infoid'
            ]);
            $input = $request->input();
            $userInfoObj->nickname = $input['nickname'];
            if(isset($input['realname']))
                $userInfoObj->realname = $input['realname'];
            if(isset($input['signature']))
                $userInfoObj->signature = $input['signature'];
            if(isset($input['introduction']))
                $userInfoObj->introduction = $input['introduction'];
            if(isset($input['email']))
                $userObj->email = $input['email'];
            $data['user'] = $userObj;
            $data['userinfo'] = $userInfoObj;
            $userObj->save();
            $userInfoObj->save();
            if($request->hasFile('avatar'))
            {
                $image = $request->file('avatar');
                if($image->getClientSize() > 2097152)
                {
                    $errMsg->add('sizeErr', 'Image file is larger than 2M!');
                }
                elseif(substr($image->getMimeType(), 0, 6) != "image/")
                {
                    $errMsg->add('typeErr', 'Image file type error!');
                }
                else
                {
                    $image->move('./avatar/', "$uid.jpg");
                }
            }
            return Redirect::to('/dashboard/profile')->withErrors($errMsg);
        }
        return View::make('dashboard.profile')->with($data);
    }

    public function showUserDashboard(Request $request)
    {
        return Redirect::to('/dashboard/profile');
        //return View::make('dashboard.index');
    }

    public function logoutAction(Request $request)
    {
        echo "logout";
        $request->session()->flush();
        return Redirect::to('/');
    }

    public function showUserIndex(Request $request, $username)
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
                return View::make('user.index')->with($data);
            }
        }
        return Redirect::to('/');
    }

    public function resetPassword(Request $request)
    {
        $data = [];
        $errMsg = new MessageBag;
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'username' => 'required|exists:users',
                'email' => 'required|email'
            ]);
            $input = $request->input();
            $email = $input['email'];
            $userObj = User::where('username', $input['username'])->first();
            if($userObj->email != $input['email'])
            {
                $errMsg->add('missmatcherr', 'Username, email don\'t match');
                return Redirect::to('/resetpasswd')->withInput($input)->withErrors($errMsg);
            }
            if(PasswordReset::where('email', $email)->first() != NULL)
                PasswordReset::where('email', $email)->delete();
            $pwdResetObj = new PasswordReset;
            $pwdResetObj->email = $email;
            $pwdResetObj->token = sha1($email . "" . time());
            Mail::send('auth.emailrequest', ['passwordReset' => $pwdResetObj], function($message) use ($pwdResetObj){
                $message->from('onionwyl@qq.com', 'onion');
                $message->to($pwdResetObj->email);
                $message->subject('[Code_platform] Reset Password Confirmation');
            });
            $data['info'] = "You will recieve an email for password reset, check for your mailbox";
            $pwdResetObj->save();
        }
        return View::make('auth.resetpasswdcheck')->with($data);
    }

    public function resetPasswordAction(Request $request)
    {
        $data = [];
        $errMsg = new MessageBag;   
        $token = $request->get('token');
        if($request->method() == "GET")
        {
            if($token == NULL)
            {
                return Redirect::to('/');
            }
            $pwdResetObj = PasswordReset::where('token', $token)->first();
            if($pwdResetObj == NULL)
            {
                return Redirect::to('/');
            }
            $data['token'] = $token;
            $data['email'] = $pwdResetObj->email;
        }
        elseif($request->method() == "POST")
        {
            if($token == NULL)
            {
                return Redirect::to('/');
            }
            $pwdResetObj = PasswordReset::where('token', $token)->first();
            if($pwdResetObj == NULL)
            {
                return Redirect::to('/');
            }
            $this->validate($request, [
                'password' => 'required|between:5,255|confirmed'
            ]);
            User::where('email', $pwdResetObj->email)->update(['password' => Hash::make($request->get('password'))]);
            return Redirect::to('/signin');
        }
        return View::make('auth.resetpasswd')->with($data);
    }

    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('qq')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $userQqObj = Socialite::driver('qq')->user();
        $userObj = User::where('openid', $userQqObj->getId())->first();
        if($userObj != null)
        {
            $request->session()->put([
                "username" => $userObj->username,
                "uid" => $userObj->uid
            ]);
            $userObj->where('uid', $userObj->uid)->update([
                'lastlogin_ip' => $request->ip(),
                'lastlogin_time' => date('Y-m-d H:i:s')
            ]);
            if($request->session()->get('lastUrl')!=NULL)
                return Redirect::to($request->session()->get('lastUrl'));
            return Redirect::to("/");
        }
        else
        {
            $request->session()->put([
                "userqq" => $userQqObj
            ]);
            return Redirect::to('/signupqq');
        }
    }

    public function registerWithQQ(Request $request)
    {
        if($request->session()->has('userqq'))
        {
            $data = [];
            $input = $request->input();
            $userQqObj = $request->session()->get('userqq');
            if($request->method() == "POST")
            {
                $this->validate($request, [
                    'username' => 'required|unique:users|between:5,255',
                    'password' => 'required|between:5,255|confirmed',
                    'email' => 'required|email|unique:users'
                ]);
                $userObject = new User;
                $userObject->username = $input['username'];
                $userObject->password = Hash::make($input['password']);
                $userObject->email = $input['email'];
                $userObject->registration_time = date("Y-m-d h:i:s");
                $userObject->registration_ip = $request->ip();
                $userObject->lastlogin_ip = $request->ip();
                $userObject->gid = 1;
                $userObject->openid = $userQqObj->getId();
                $userObject->save();
                $userObject=User::where('username',$request->username)->first();
                $request->session()->put([
                    "username" => $userObject->username,
                    "uid" => $userObject->uid
                ]);
                $request->session()->forget('userqq');
                $userInfoObj = new UserInfo;
                $userInfoObj->uid = $userObject->uid;
                $userInfoObj->nickname = $userQqObj->nickname;
                $userInfoObj->save();
                $client = new Client();
                $response = $client->get($userQqObj->getAvatar(), ['save_to' => public_path('avatar/'.$userObject->uid.'.jpg')]);
                return Redirect::to("/");
            }
            return View::make('auth.registerwithQQ');
        }
        return Redirect::to('/');
    }

    public function bindQQ(Request $request)
    {
        if($request->session()->has('userqq'))
        {
            $userQqObj = $request->session()->get('userqq');
            $data = [];
            $input = $request->input();
            $errMsg = new MessageBag;
            if($request->method() == "POST")
            {
                $this->validate($request, [
                    'username' => 'required|exists:users,username',
                    'password' => 'required'
                ]);
                $username = $input['username'];
                $password = $input['password'];
                $userObj = User::where('username', $username)->first();
                if(Hash::check($password, $userObj->password))
                {
                    $request->session()->put([
                        "username" => $userObj->username,
                        "uid" => $userObj->uid
                    ]);
                    $request->session()->forget('userqq');
                    $userObj->where('uid', $userObj->uid)->update([
                        'lastlogin_ip' => $request->ip(),
                        'lastlogin_time' => date('Y-m-d H:i:s'),
                        'openid' => $userQqObj->getId()
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
            return View::make('auth.bindQQ')->withErrors($errMsg);
        }
        return Redirect::to('/');
    }

    public function changePassword(Request $request)
    {
        $data = [];
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'oldpassword' => 'required',
                'password' => 'required|between:5,255|confirmed'
            ]);
            $userObj = User::where('uid', $request->session()->get('uid'))->first();
            if(Hash::check($request->input('password'), $userObj->password))
            {
                $userObj->password = Hash::make($request->input('password'));
                $data['passchange'] = "Password changed successfully.";
            }
        }
        return View::make('dashboard.account')->with($data);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function checkAdmin()
    {
        $uid = session('uid');
        if(User::select('gid')->where('uid', $uid)->first()->gid == 0)
            return ture;
        return false;
    }
}

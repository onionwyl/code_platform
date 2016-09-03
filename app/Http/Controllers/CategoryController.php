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

class CategoryController extends Controller
{
    public function showCategoryList(Request $request)
    {
        $data = [];
        $data['cats'] = [];
        $categoryObj = Category::all();
        for($i = 0; $i < $categoryObj->count(); $i++)
        {
            $categoryObj[$i]->count = Repository::select('rid')->where('catid', $categoryObj[$i]->catid)->get()->count();
        }
        $data["cats"] = $categoryObj;
        return View::make('category.list')->with($data);
    }

    public function showCategoryByCatID(Request $request, $cat_id)
    {
        $data = [];
        $categoryObj = Category::where('catid', $cat_id)->first();
        if($categoryObj == NULL)
            return Redirect::to('/');
        $repositoryObj = Repository::where('catid', $cat_id)->get();
        $categoryObj->count = $repositoryObj->count();
        for($i = 0; $i < $repositoryObj->count(); $i++)
        {
            $repositoryObj[$i]->username = User::where('uid', $repositoryObj[$i]->uid)->first()->username;
        }
        $data['cat'] = $categoryObj;
        $data['repos'] = $repositoryObj;
        return View::make('category.repo')->with($data);
    }

    public function showAdminCategoryDashboard(Request $request)
    {
        $data = [];
        $categoryObj = Category::all();
        for($i = 0; $i < $categoryObj->count(); $i++)
        {
            $categoryObj[$i]->count = Repository::select('rid')->where('catid', $categoryObj[$i]->catid)->get()->count();
        }
        $data['cats'] = $categoryObj;
        return View::make('admin.catlist')->with($data);
    }

    public function addCategory(Request $request)
    {
        $data = [];
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'catname' => 'required|unique:category'
            ]);
            $categoryObj = new Category;
            $categoryObj->catname = $request->get('catname');
            $categoryObj->save();
            return Redirect::to('/dashboard-admin/category');
        }
        return View::make('category.add');
    }

    public function editCategory(Request $request, $cat_id)
    {
        $data = [];
        $categoryObj = Category::where('catid', $cat_id)->first();
        if($request->method() == "POST")
        {
            $this->validate($request, [
                'catname' => 'required|unique:category,catname,'.$cat_id.',catid'
            ]);
            $categoryObj->catname = $request->get('catname');
            $categoryObj->save();
            return Redirect::to('/dashboard-admin/category');
        }
        $data['cat'] = $categoryObj;
        return View::make('category.edit')->with($data);
    }

    public function deleteCategory(Request $request, $cat_id)
    {
        $data = [];
        $categoryObj = Category::where('catid', $cat_id)->first();
        if($categoryObj == NULL)
            return Redirect::to ('/dashboard-admin/category');
        Repository::where('cid', $cat_id)->update(['cid' => 0]);
        $categoryObj->delete();
        return Redirect::to('/dashboard-admin/category');
    }

}

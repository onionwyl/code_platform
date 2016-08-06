<?php

namespace App\Http\Controllers;

use View;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\User;
use App\UserInfo;
use App\Repository;
use App\Category;
use App\Code;
use App\Submission;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function runCode(Request $request)
    {
        $data = [];
        $errMsg = new MessageBag;
        if($request->method() == "POST")
        {
            $input = $request->input();
            $submissionObj = Submission::where(['uid' => $request->session()->get('uid'), 'run_status' => 0])->first();
            if($submissionObj != NULL)
            {
                $errMsg->add('runerr', 'Please wait until last submission run over');
                return Redirect::to('/run?sid='.$submissionObj->sid)->withInput($input)->withErrors($errMsg);
            }
            $this->validate($request, [
                'code' => 'required'
            ]);
            $submissionObj =  new Submission;
            $submissionObj->uid = $request->session()->get('uid');
            $submissionObj->submit_time = date('Y-m-d-H:i:s');
            $submissionObj->code = $input['code'];
            $submissionObj->lang = $input['lang'];
            $submissionObj->input = $input['input'];
            $submissionObj->output = "";
            $submissionObj->err_info = "";
            $submissionObj->run_status = 0;
            $submissionObj->save();
            $submissionObj = Submission::where(['uid' => $request->session()->get('uid'), 'run_status' => 0])->first();
            return Redirect::to('/run?sid='.$submissionObj->sid);
        }
        $data['code'] = "";
        $data['input'] = "";
        $data['output'] = "";
        $data['err_info'] = "";
        if($request->has('cid'))
        {
            $codeObj = Code::where('cid', $request->get('cid'))->first();
            $data['code'] = $codeObj->content;
        }
        if($request->has('sid'))
        {
            if($request->session()->has('uid'))
            {
                $submissionObj = Submission::where(['uid' => $request->session()->get('uid'), 'sid' => $request->get('sid')])->first();
                if($submissionObj == NULL)
                    return Redirect::to('/run');
                $data['code'] = $submissionObj->code;
                $data['input'] = $submissionObj->input;
                $data['output'] = $submissionObj->output;
                $data['err_info'] = $submissionObj->err_info;
            }
            else
                return Redirect::to('/run');
        }
        return View::make('run')->with($data);
    }
}

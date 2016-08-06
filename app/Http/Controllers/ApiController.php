<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Submission;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getCode(Request $request)
    {
        $submissionObj = Submission::where('run_status', 0)->first();
        return response()->json($submissionObj);
    }

    public function putResult(Request $request)
    {

    }
}

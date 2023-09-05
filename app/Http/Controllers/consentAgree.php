<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class consentAgree extends Controller
{
    public function consent(Request $request)
    {
        return view('consent');
    }

    /**
    * Handle an incoming request.
    *
    * @param  Request  $request
    * @param  int $id
    * @return Response
    */

    public function confirm(Request $request)
    {
        //much like the tutorial page, we want to limit the ammount of times someone can access this page
        $sid = session('sid');
        $dbStatement = "SELECT COUNT(sid) from demographics where sid = '".$sid."'";
        $recCount = DB::select($dbStatement);
        $cnt = "COUNT(sid)";
        $count = $recCount[0]->$cnt;
        if ($request->has('consent')) {
            session(['confirmed' => 1]);
            if ($count != 0) {
                return redirect('/tutorial');
            }
            else {
                return view('demographic');
            }
        } else {
            return redirect('/');
        }
    }
    public function restrictPage(Request $request)
    {
        if (!$request->session->exists('confirmed')) {
            return redirect('/');
        }
    }
}

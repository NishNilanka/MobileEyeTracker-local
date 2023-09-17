<?php

namespace App\Http\Controllers;

use App\Models\LuxValue;
use Illuminate\Http\Request;

class LuxValueController extends Controller
{
    public function store(Request $request)
    {
        $sessionId = session('sid');
        $dateTimeset = date('Y-m-d H:i:s');
        $dateTime1 = str_replace(":", ".", $dateTimeset);
        $dateTime = str_replace("-", ".",  $dateTime1);

        $videoID = $request->videoID;
        $luxvalue= $request->luxValue;

        $luxValue = new LuxValue([
            'sid' => $sessionId,
            'videoid'=> $videoID,
            'luxvalue' => $luxvalue,
            'created_at' => $dateTime,
            'updated_at' => $dateTime
        ]);

        $luxValue->save();
    }

}

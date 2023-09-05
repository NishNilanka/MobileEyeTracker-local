<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewFile;

class VideoController extends Controller
{
    /**
    * Handle the incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function __invoke(Request $request)
    {
        //
    }

    public function save(Request $request){

        $sessionId = session('sid');
        $dateTimeset = date('Y-m-d H:i:s');
        $dateTime1 = str_replace(":", ".", $dateTimeset);
        $dateTime = str_replace("-", ".",  $dateTime1);

        $filename = $sessionId." ".$dateTime.".mp4";
        $filesize = filesize($request->file('video'));
        $recordingsURL=storage_path('app\recordings\recordings');
        $path = $request->file('video')->storeAs('recordings', $filename);


        NewFile::Create([
            'sid' => $sessionId,
            'filename' => $filename,
            'fileLocation' => $recordingsURL.'/'.$filename,
            'filesize' => $filesize,
            'fileDownloaded' => "0",
            'timeCreated' => $dateTime,
            'created_at' => $dateTime,
            'updated_at' => $dateTime
            ]);

        return ['path'=>$path,'upload'=>'success'];
    }

    }

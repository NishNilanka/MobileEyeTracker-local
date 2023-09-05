<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Delete extends Controller
{
    /**
    * Handle the incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {

        //call selected videos array
        $selectedVideos = $request->input('filenames');
        if ($selectedVideos == null) {
            return redirect("/filesystem");
        }

        //Make ID array
        $i = 0;
        foreach ($selectedVideos as $filename) {
            $idArrayMass[$i] = substr($filename, 0, 16);
            $i = $i + 1;
        }

        //remove duplicate IDs so the csv doesn't have duplicated entries
        $idArray = array_unique($idArrayMass);

        //recordings url
        $recordingsURL=storage_path('app/recordings/recordings');

        foreach ($idArray as $sentID) {
            $filesysSql = 'DELETE FROM filesystem WHERE `sid` = "'.$sentID.'"';
            $demosysSql = 'DELETE FROM demographics WHERE `sid` = "'.$sentID.'"';
            //call database
            DB::delete($filesysSql);
            DB::delete($demosysSql);
        }

        foreach ($selectedVideos as $filename) {
            if (file_exists($recordingsURL . '/'.$filename) == true) {
                File::delete($recordingsURL.'/'.$filename);
            }
            return redirect("/filesystem");
        }
    }
}

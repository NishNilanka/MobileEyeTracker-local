<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBackend extends Controller
{

    //this function returns an array of files in target dir
    public static function dirToArray(){

        //get all filenames in array
        $finalArray = array_slice(scandir(storage_path()."/app/recordings"),2);

        //iterate through array with $key as key and $value as value
        foreach($finalArray as $key => $value){
            //set current key to filename, instead of numerical index
            $key = $value;

            //set value for the filename as an array of corresponding data from db
            $value = DB::select('select * from demographics where id = ?', [$key]);

            //dump the contents of value
            var_dump($value);
        }
    }


    //function to get filesizes of scanned dir
    public static function dirFileSizes(){
        $picsArray = array_slice(scandir(storage_path()."/app/pics"),2);

        foreach($picsArray as $filename){
            $size = filesize(storage_path()."/app/pics/".$filename);
            echo("File called ".$filename." is ".$size." big.<br>");
        }
    }
}

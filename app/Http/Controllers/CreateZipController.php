<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\DB;

/* $selectedVideos is an Array sent from the admin page containing the filenames (just names) of the files requested to be downloaded.
my issue now is getting $selectedVideos sent into this controller.
*/

class CreateZipController extends Controller
{
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        //call array
        $selectedVideos= $request->input('filenames');
        if ($selectedVideos == null) {
            return redirect("/filesystem");
        }
        //make missing variable and missing boolean
        $bmissing = false;
        $missing = "";
        //Make ID array
        $i = 0;
        foreach ($selectedVideos as $filename) {
            $idArrayMass[$i] = substr($filename, 0, 16);
            $i = $i + 1;
        }
        //remove duplicate IDs so the csv doesn't have duplicated entries
        $idArray = array_unique($idArrayMass);
        //sets to target Recordings url
        $recordingsURL=storage_path('app/recordings/recordings');
        //make new zip archive
        $zip = new ZipArchive;
        //get date
        $date = date("Y-m-d");
        // zip archive name
        $zipFileName = 'EyeTrackerRecordings-' .$date.'.zip';
        //if statement to see if zip open and create archive
        if ($zip->open( $recordingsURL . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            // loop through array and Add Files in ZipArchive
            foreach ($selectedVideos as $video_file) {
                //check if the file exists, it it doesn't add a text file flagging it couldnt be found
                if (file_exists($recordingsURL . '/'.$video_file) == true) {
                $zip->addFile($recordingsURL . '/'.$video_file, $video_file);
                DB::update(
                    'update filesystem set fileDownloaded = 1 where filename = ?',
                    [$video_file]);
                } else {
                    $bmissing = true;
                    $missing = $missing.", ". $video_file;
                    DB::update(
                        'update filesystem set fileDownloaded = 1 where filename = ?',
                        [$video_file]);
                }
            }
                // Fopen CSV and store in Recordings (there will be a csv file stored in storage, but will be overwritten everytime its downloaded)
                $csv = fopen($recordingsURL.'\selected.csv', 'w');
                //Create headings array and publish it into first line of csv
                $headingsArray = array("sid", "age", "glasses", "gender", "deviceMobile", "Created At", "Updated At");
                fputcsv($csv, $headingsArray);

                //collect the ID and grab the data required for the videos that have been selected to download
                foreach ($idArray as $sentID) {
                    $testSql = 'select sid, age, glasses, gender, deviceMobile, created_at, updated_at  from demographics WHERE `sid` = "'.$sentID.'"';
                    //call database
                    $DBArray = DB::select($testSql);
                    //strip DB select array of objects and insert to new array
                    $selectedArray = get_object_vars($DBArray[0]);
                    //insert new array into csv and loop to do next selected ID
                    fputcsv($csv, $selectedArray);
                }
                // close CSV edit
                fclose($csv);
                // Add CSV to zip Archive
                $zip->addFile($recordingsURL.'\selected.csv', 'selected.csv');
                        }
            //if statement for when the video files are missing
            if ($bmissing == true){
                file_put_contents("Missing Videos.txt",
                "In this zip download request there were missing files,\n These missing files include ". $missing .".\n\nThese files were likely accidentally deleted or moved from the \n'".$recordingsURL."' directory.");
                $zip->addFile("Missing Videos.txt", "Missing Videos.txt");
            }
            //Close zip archive

            $zip->close();
            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath= $recordingsURL.'/'.$zipFileName;
            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers)->deleteFileAfterSend(true);
            }

            return view('tutorial');
        }
    }

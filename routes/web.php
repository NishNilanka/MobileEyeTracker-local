<?php

use App\Http\Controllers\consentAgree;
use App\Http\Controllers\DataExportController;
use App\Http\Controllers\FilesystemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demographic;
use App\Models\DeviceModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route for index
Route::get('/', function () {
    return view('index');
});

Route::get('/calibration', function () {
    return view('calibration');
});

//Route to demographics page, requires consentAgree
Route::match(['GET', 'POST'], '/demographic', [App\Http\Controllers\consentAgree::class, 'confirm']);


// Route to tutorial page has included statements to ensure people are in a session and they cant record more than 3 recordings.
Route::match(['GET', 'POST'], '/tutorial', function (Request $request) {
    //no entry if session doesn't exist
    //This checks the ammount of recordings created under the sid, not allowing further access to those that have recorded 3 or more.
    // Pull session ID
    $sid = session('sid');
    //count ammount of table entries with sid
    $dbStatement = "SELECT COUNT(sid) from filesystem where sid = '" . $sid . "'";
    $recCount = DB::select($dbStatement);
    //a string as the object below requires string in variable and not string alone e.g. $recCount[0]->"COUNT(sid)"; is a syntax error
    $cnt = "COUNT(sid)";
    $count = $recCount[0]->$cnt;
    if (!$request->session()->exists('confirmed')) {
        return redirect('/');
    }
    //checks if returned count is greater or equal to 3. If it is, it redirects to task completed page
    elseif ($count >= 3) {
        return view('taskcompleted');
    } else {
        //if both prior if statements return true, then user continues to tutorial page
        return view('tutorial');
    }
});

//Route to generate the unique userid for Amaozon Mturk
Route::get('uid', [App\Http\Controllers\UserIDController::class, 'generateID']);

//Route to tahnk you page, only works if user has active session, otherwise redirects to main.
Route::get('/thankyou', function (Request $request) {
    if (!$request->session()->exists('confirmed')) {
        return redirect('/');
    } else {
        //Flush Session not its over
        session()->flush();
    }
    return view('thankyou');
});

//Route to filesystem, requires authentication.
Route::get('/filesystem', function (Request $request) {
    return view('filesystem');
})->middleware('auth')->name('filesystem');

/* Route that prints session ID for debugging.
Route::get('/sid', function () {
    $sid = session('sid');
    dd($sid);
});
*/

//Route for generating .CSV of entire demograhpics database, requires auth.
Route::get('/generate-csv', function () {
    $dateTime = date('Y-m-d H.i.s');
    $csv = fopen('CSV-'.$dateTime.'.csv', 'w');

    //first line of titles
    $headingsArray = array("id", "session-id", "age", "glasses", "gender", "deviceMobile", "Created At", "Updated At");
    fputcsv($csv, $headingsArray);
    $testSql = 'select *  from demographics';
    //call database
    $DBArray = DB::select($testSql);
    //strip DB select array of objects and insert to new array
    for ($i = 0; $i < count($DBArray); $i++) {
        $selectedArray = get_object_vars($DBArray[$i]);
        fputcsv($csv, $selectedArray);
    }
    // close CSV edit
    fclose($csv);
    return response()->download('CSV-'.$dateTime.'.csv')->deleteFileAfterSend(true);
})->middleware('auth');

//Including Auth facade routes.
Auth::routes();

//Route for resetting password, requires auth.
Route::get('/resetpassword', function(){
    return view('resetpassword');
})->middleware('auth');

//Logic for resetting password from /resetpassword.
Route::post('/reset', function(Request $request){
    //Validate password inputs from /resetpassword.
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required',
      ]);

      //Retriever logged-in user object.
      $user = Auth::user();

      //Check if password matches, if not redirect to failure page.
      if (!Hash::check($request->current_password, $user->password)) {
          return view('resetfail');
      }

      //Hash new password input and save to user object.
      $user->password = Hash::make($request->password);
      $user->save();

      //Return to previous page when successful.
      return back();
  });

  //Route for resetfail. Requires auth.
Route::get('/resetfail', function(){
    return view('resetfail');
})->middleware('auth');

//Route for logging out. Requires auth.
Route::get('/logout', function(Request $request){
    //Call logout, invalidate current session and redirect.
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth');



//Route for posting new demographic information.
Route::post('/post', function (Request $request) {
    //Create SID for the session, hash of microtime with salt.
    $sid = substr(hash('sha512', microtime() . 'amogus'), 0, 16);
    session(['sid' => $sid]);

    //Create new demographic entry from model.
    Demographic::Create([
        'sid' => $sid,
        'age' => $request->ageInput,
        'glasses' => $request->glassesInput,
        'gender' => $request->genderInput,
        'deviceMobile' => $request->MoblileOrTablet,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);


        $deviceModel = new DeviceModel([
            'sid' => $sid,
            'brand' => $request->brand,
			'model' => $request->model,
			'useragent' => $request->useragent,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'dpr' => $request->dpr
        ]);
        $deviceModel->save();

        return redirect('tutorial');
});

//video Download route, requires auth.
Route::post('/create-zip', [App\Http\Controllers\CreateZipController::class, 'index',])->name('create-zip')->middleware('auth');

//Route to Delete demographic/storage entry. Requires auth.
Route::post('/delete', [App\Http\Controllers\Delete::class, 'index',])->name('delete')->middleware('auth');

//Route to upload new recording.
Route::post('/videoRec', [App\Http\Controllers\VideoController::class, 'save']);

//Route to upload deviceOrientation
Route::post('/deviceorientation', [App\Http\Controllers\DeviceOrientationController::class, 'store']);


//Route to upload coordinates
Route::post('/coordinates', [App\Http\Controllers\CoordinatesController::class, 'store']);

//Route to store mobile camera data
Route::post('/camerafeatures', [App\Http\Controllers\CameraFeatureController::class, 'store']);

// routes/web.php
Route::post('/run-python-script', 'App\Http\Controllers\PythonController@runScript');




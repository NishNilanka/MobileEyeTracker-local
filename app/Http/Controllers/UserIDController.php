<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewFile;

include_once 'Mobile_Detection.php';


class UserIDController extends Controller
{

    public function generateID(Request $request)
    {
        //$UserID= $request->input('filenames');
		// Check for any mobile device.
		$detect = new Mobile_Detection();
		if ($detect->isMobile()){
		   return md5(uniqid(rand(), true));
		}
		else {
		   return "hi";
		}
        
    }
}
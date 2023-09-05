<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demographic;
use Hash;

class DemographicsController extends Controller
{

    /*submits form data into mySQL database
    public function formToDatabase(Request $request){



        $id = $this->createID();

        Demographic::Create([
            'id' => $id,
            'age' => $request->ageInput,
            'ethnicity' => $request->ethnicityInput,
            'glasses' => $request->glassesInput,
            'gender' => $request->genderInput,
            'deviceMobile' => $request->MoblileOrTablet
        ]);

        //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln(dd($request));

    }*/
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PythonController extends Controller
{
    //
    public function runScript(Request $request)
    {
        $input = $request->input('input_data'); // Adjust how you retrieve input

        $scriptPath = "C:/xampp/htdocs/mobileeyetracker/public_html/SCS121-5/PythonScript/main.py";
        $escapedScriptPath = escapeshellarg($scriptPath);

        $command = "python {$escapedScriptPath}";
        $output = [];
        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            // Script executed successfully
            return response()->json(['output' => $output]);
        } else {
            // Script encountered an error
            return response()->json(['error' => 'Script execution failed'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataExporter;
use Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\download;

class FilesystemController extends Controller
{

    public function exportIntoExcel()
    {
        return FacadesExcel::download(new DataExporter, 'filelist.xls');
    }

    public function exportIntoCSV()
    {
        return FacadesExcel::download(new DataExporter, 'filelist.csv');
    }


}

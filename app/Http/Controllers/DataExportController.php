<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataExporter;
use App\Models\DataExport;
use Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class DataExportController extends Controller
{
    public function exportIntoExcel()
    {
        return FacadesExcel::download(new DataExporter, 'datalist.xlsx');
    }

    public function exportIntoCSV()
    {
        return FacadesExcel::download(new DataExporter, 'datalist.csv');
    }
}

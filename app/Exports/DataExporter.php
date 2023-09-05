<?php

namespace App\Exports;

use App\Models\DataExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExporter implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'id',
            'sid',
            'age',
            'glasses',
            'gender',
            'deviceMobile',
            'created_at',
            'updated_at'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return DataExport::all();
        return collect(DataExport::getData());
    }

}

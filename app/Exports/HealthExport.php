<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HealthExport implements FromView
{
    protected $healthRecords;

    public function __construct($healthRecords)
    {
        $this->healthRecords = $healthRecords;
    }

    public function view(): View
    {
        return view('admin.health.exports.excel', [
            'healthRecords' => $this->healthRecords
        ]);
    }
}


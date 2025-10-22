<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentServicesExport implements FromView
{
    protected $studentServices;

    public function __construct($studentServices)
    {
        $this->studentServices = $studentServices;
    }

    public function view(): View
    {
        return view('admin.student_services.exports.excel', [
            'studentServices' => $this->studentServices
        ]);
    }
}


<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VtcStudentsExport implements FromView
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function view(): View
    {
        return view('admin.vtc_students.exports.excel', [
            'vtcStudents' => $this->students
        ]);
    }
}


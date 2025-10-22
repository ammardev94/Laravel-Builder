<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VtcAttendenceExport implements FromView
{
    protected $vtcAttendences;

    /**
     * Create a new export instance.
     *
     * @param  mixed  $vtcAttendences
     */
    public function __construct($vtcAttendences)
    {
        $this->vtcAttendences = $vtcAttendences;
    }

    /**
     * Return a view for the Excel export.
     */
    public function view(): View
    {
        return view('admin.vtc_attendance.exports.excel', [
            'vtcAttendences' => $this->vtcAttendences,
        ]);
    }
}

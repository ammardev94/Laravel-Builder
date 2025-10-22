<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FamiliesExport implements FromView
{
    protected $families;

    public function __construct($families)
    {
        $this->families = $families;
    }

    public function view(): View
    {
        return view('admin.families.exports.excel', [
            'families' => $this->families
        ]);
    }
}


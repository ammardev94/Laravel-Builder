<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FamilyServicesExport implements FromView
{
    protected $familyServices;

    public function __construct($familyServices)
    {
        $this->familyServices = $familyServices;
    }

    public function view(): View
    {
        return view('admin.family_services.exports.excel', [
            'familyServices' => $this->familyServices
        ]);
    }
}
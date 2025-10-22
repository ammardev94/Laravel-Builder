<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donor;
use App\Models\Course;
use App\Models\Family;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\VtcStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index (): View
    {
        return view("admin.dashboard");
    }
}

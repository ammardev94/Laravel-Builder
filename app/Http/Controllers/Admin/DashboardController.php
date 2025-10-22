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
        $familiesCount = Family::all()->count();
        $studentCount = Student::all()->count();
        $donorCount = Donor::all()->count();
        $vtcStudentCount = VtcStudent::all()->count();

        $genderStats = VtcStudent::select('gender', DB::raw('COUNT(id) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender')
            ->toArray();

        $vtcStudentGenderStats = [
            "labels" => array_map(fn($gender) => ucfirst($gender), array_keys($genderStats)),
            "data" => array_values($genderStats)
        ];

        $maritalStats = VtcStudent::select('marital_status', DB::raw('COUNT(id) as total'))
            ->groupBy('marital_status')
            ->pluck('total', 'marital_status')
            ->toArray();

        $vtcMaritalStats = [
            "labels" => array_map(fn($marital_status) => ucfirst($marital_status), array_keys($maritalStats)),
            "data" => array_values($maritalStats)
        ];

        $studentCourses = Course::select('courses.name', DB::raw('COUNT(vtc_student_courses.vtc_student_id) as total'))
            ->join('vtc_student_courses', 'courses.id', '=', 'vtc_student_courses.course_id')
            ->groupBy('vtc_student_courses.course_id', 'courses.name')
            ->get();

        $colors = $studentCourses->map(function ($course) {
            $hash = substr(md5($course->name), 0, 6);
            return "#{$hash}";
        });

        $courseStats = [
            "labels" => $studentCourses->pluck('name')->map(fn($name) => ucfirst($name))->toArray(),
            "data"   => $studentCourses->pluck('total')->toArray(),
            "colors" => $colors->toArray(),
        ];


        $vtcStudentZakatStats = VtcStudent::select('zakat', DB::raw('COUNT(id) as total'))
            ->groupBy('zakat')
            ->pluck('total', 'zakat')
            ->toArray();

        $vtcZakatStats = [
            "labels" => array_map(fn($zakat) => $zakat == 1 ? 'Yes' : 'No', array_keys($vtcStudentZakatStats)),
            "data" => array_values($vtcStudentZakatStats),
        ];


        $studentTrends = VtcStudent::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('COUNT(id) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $vtcStudentTrends = [
            'labels' => array_keys($studentTrends),
            'datasets' => [
                [
                    'label' => 'Students Enrolled',
                    'data' => array_values($studentTrends),
                    'borderColor' => '#3c8dbc',
                    'fill' => false,
                    'tension' => 0.3,
                ]
            ]
        ];

        return view("admin.dashboard", compact(
            'familiesCount', 
            'studentCount', 
            'donorCount', 
            'vtcStudentCount',
            'vtcStudentGenderStats',
            'vtcMaritalStats',
            'courseStats',
            'vtcZakatStats',
            'vtcStudentTrends'
        ));
    }
}

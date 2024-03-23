<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(Request $request): View
    {
        $student = Auth::guard('student')->user();

        $dorm = (!empty($student->dorm))? $student->dorm: null;

        return view('students.dashboard.index')
            ->with([
                'student' => $student,
                'dorm' => $dorm->name
            ]);
    }
}

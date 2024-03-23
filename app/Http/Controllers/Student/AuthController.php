<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('students.auth.login');
    }
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'studentID' => 'required',
            'password' => 'required'
        ]);
        $student = Student::where('studentID', $request->get('studentID'))->first();
        if (Hash::check((string)$request->get('password'), $student->password)){
            Auth::guard('student')->login($student);
            return redirect()->route('student-dashboard');
        }else{
            return redirect()->route('student-login.form')->withErrors(['password'=>'Wrong Pass']);
        }
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('student')->logout();
        return redirect()->route('student-login.form');
    }
}

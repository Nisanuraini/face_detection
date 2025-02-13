<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Pickup;
use App\Models\School;
use App\Models\ListFaceDetection;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalstudents = Student::count();
        $totalclasses = Classroom::count();
        $totalpickups = Pickup::count();
        $totalschools = School::count();
        $recentListFaceDetection = ListFaceDetection::latest()->take(5)->get();
        return view('admin.index', compact('totalstudents', 'totalclasses', 'totalpickups', 'recentListFaceDetection', 'totalschools'));
    }
}

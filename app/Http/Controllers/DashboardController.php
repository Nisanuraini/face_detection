<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Pickup;
use App\Models\Classroom;
use App\Models\School;
use App\Models\ListFaceDetection; // Pastikan model ini ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalclasses = Classroom::count();
        $totalschools = School::count();
        $totalstudents = Student::count(); 
        $totalpickups = Pickup::count(); 
        $recentListFaceDetection = ListFaceDetection::latest()->take(5)->get(); 
        $totalclasses = Classroom::count();
        return view('admin.index', compact('totalclasses','totalstudents', 'totalschools', 'totalpickups', 'recentListFaceDetection', 'totalclasses')); 
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Pickup;
use App\Models\Classroom;
use App\Models\ListFaceDetection; // Pastikan model ini ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count(); 
        $totalPickups = Pickup::count(); 
        $recentListFaceDetection = ListFaceDetection::latest()->take(5)->get(); 
        $totalClasses = Classroom::count();
        return view('admin.dashboard', compact('totalStudents', 'totalPickups', 'recentListFaceDetection', 'totalClasses')); 
    }
}
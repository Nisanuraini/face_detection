<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom; 
use App\Models\Student; 
use App\Models\Pickup;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count(); 
        $totalPickups = PickUp::count(); 
        $recentPickups = PickUp::latest()->take(5)->get();
        $totalClasses = Classroom::count();

        return view('admin.dashboard', compact('totalStudents', 'totalPickups', 'recentPickups', 'totalClasses')); // Pastikan file Blade ini ada
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Class;
use App\Models\Student; 
use App\Models\Pickup;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count(); 
        $totalPickups = PickUp::count(); 
        $recentPickups = Pickup::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalStudents', 'totalPickups', 'recentPickups')); // Pastikan file Blade ini ada
    }

}
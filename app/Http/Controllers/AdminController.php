<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\Pickup;

class AdminController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count(); 
        $totalPickups = PickUp::count(); 
        $recentPickups = Pickup::latest()->take(5)->get();
        $students = Student::all();
        
        return view('admin.dashboard', compact('totalStudents', 'totalPickups', 'recentPickups')); 
        return view('admin.students.create', compact('students'));
    } 
    public function home()
    {
        // Logika untuk halaman admin home
        return view('admin/home'); // Pastikan file Blade ada
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\Classroom;
use App\Models\School;
use App\Models\ListFaceDetection;
use App\Models\Pickup;

class AdminController extends Controller
{
    public function index()
    {
        $totalstudents = Student::count(); 
        $totalclasses = Classroom::count();
        $totalschools = School::count();
        $totalpickups = PickUp::count(); 
        $recentListFaceDetection = ListFaceDetection::latest()->take(5)->get();
        $students = Student::all();
        
        return view('admin.index', compact('totalstudents', 'totalclasses', 'totalschools',  'recentListFaceDetection','totalpickups')); 
    } 
}

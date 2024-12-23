<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::with('student', 'classroom')->get();
        return view('admin.schools.index', compact('schools'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $classes = Classroom::all();
        return view('admin.schools.create', compact('students', 'classes'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
        ]);
    
        School::create($request->all());
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('admin.schools.show', compact('school'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        $students = Student::all();
        $classes = Classroom::all();
        return view('admin.schools.edit', compact('school', 'students', 'classes'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
        ]);
    
        $school->update($request->all());
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil diupdate.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil dihapus.');
    }
}
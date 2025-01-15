<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classroom;
use App\Models\Student;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all(); 
        $classes = Classroom::all(); 
        return view('admin.schools.index', compact('schools', 'classes'));
    }
    
    public function create()
    {
        $students = Student::all();
        $classes = Classroom::all();
        return view('admin.schools.create', compact('students', 'classes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'total_classes' => 'required|integer|min:0',
            'total_students' => 'required|integer|min:0',
        ]);

        School::create($request->only(['name', 'total_classes', 'total_students']));
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }
    
    public function show(School $school)
    {
        return view('admin.schools.show', compact('school'));
    }
    
    public function edit(School $school)
    {
        return view('admin.schools.edit', compact('school'));
    }
    
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'total_classes' => 'required|integer|min:0',
            'total_students' => 'required|integer|min:0',
        ]);

        $school->update($request->only(['name', 'total_classes', 'total_students']));
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil diperbarui.');
    }
    
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom; 
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $schools = School::all();
        $students = Student::with('classroom')->get(); 
        $classes = Classroom::all();
        return view('admin.students.index', compact('students', 'classes', 'schools'));
    }

    public function create()
    { 
        $classes = Classroom::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request) 
    { 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'class_id' => 'required|exists:classes,id', 
            'school_id' => 'required|exists:schools,id',
            'alamat' => 'nullable|string',
            'nama_orangtua' => 'nullable|string',
            'kontak_orangtua' => 'nullable|string',
            'kontak_darurat' => 'nullable|string', 
            'nama_penjemput' => 'nullable|string', 
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('student_image')) {
            $validated['student_image'] = $request->file('student_image')->store('students', 'public');
        }
        
        Student::create($validated);
        
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student = $student->load('classroom', 'school', 'pickups');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = Classroom::all();
        $schools = School::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'class_id' => 'required|exists:classes,id', 
            'school_id' => 'required|exists:schools,id',
            'alamat' => 'nullable|string|max:255',
            'nama_orangtua' => 'nullable|string|max:255',
            'kontak_orangtua' => 'nullable|string|max:255',
            'kontak_darurat' => 'nullable|string|max:255',
            'nama_penjemput' => 'nullable|string|max:255',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            

        ]);

        if ($request->hasFile('student_image')) {
            $validated['student_image'] = $request->file('student_image')->store('students', 'public');
        }
        
        $student = Student::findOrFail($id);
        $student->update($validated);

        return redirect()->route('students.index', $student->id)->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
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
            'classroom_id' => 'required|exists:classes,id', 
            'school_id' => 'required|exists:schools,id',
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_contact' => 'nullable|string',
            'emergency_contact' => 'nullable|string', 
            'pickup_name' => 'nullable|string', 
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
        }
        
        Student::create($validated);
        
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student = $student->load('classroom', 'school');
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
            'classroom_id' => 'required|exists:classes,id', 
            'school_id' => 'required|exists:schools,id',
            'address' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_contact' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'pickup_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            

        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students', 'public');
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

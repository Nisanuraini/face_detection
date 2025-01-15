<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom; 
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('classroom')->get(); 
        return view('admin.students.index', compact('students'));
    }

    public function create()
    { 
        $classes = Classroom::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'class_id' => 'required|exists:classes,id', 
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_contact' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'pickup_person' => 'nullable|string',
        ]);
        
        if ($request->hasFile('student_image')) {
            $validated['student_image'] = $request->file('student_image')->store('students', 'public');
        }
        
        $validated['class_id'] = $request->input('class_id'); 
        
        Student::create($validated); 
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student = $student->load('classroom');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = Classroom::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'class_id' => 'required|exists:classes,id', 
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_contact' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'pickup_person' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('students', 'public');
            $student->student_image = $imagePath;
        }

        // Update student data
        $student->name = $request->input('name');
        $student->nis = $request->input('nis');
        $student->class_id = $request->input('class_id');
        $student->address = $request->input('address');
        $student->parent_name = $request->input('parent_name');
        $student->parent_contact = $request->input('parent_contact');
        $student->emergency_contact = $request->input('emergency_contact');
        $student->pickup_person = $request->input('pickup_person');
        $student->save();
    
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
    
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}

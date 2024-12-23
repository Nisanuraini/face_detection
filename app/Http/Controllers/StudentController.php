<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
        ]);

        Student::create([
            'name' => $request->name,
            'nis' => $request->nis,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $id,
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'nis' => $request->nis,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus');
    }
}

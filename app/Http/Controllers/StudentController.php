<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Kelas;
use App\Models\Pickup;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Menampilkan semua data siswa
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    // Menampilkan form untuk membuat siswa baru
    public function create()
    {
        return view('students.create');
    }

    // Menyimpan data siswa baru
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

    // Menampilkan detail siswa berdasarkan ID
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    // Menampilkan form untuk mengedit data siswa
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Mengupdate data siswa
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

    // Menghapus data siswa
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus');
    }
}

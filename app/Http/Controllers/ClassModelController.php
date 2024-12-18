<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    // Menampilkan semua data kelas
    public function index()
    {
        $classes = ClassModel::with('students')->get(); // Mengambil data kelas dengan relasi siswa
        return view('classes.index', compact('classes'));
    }

    // Menampilkan form untuk membuat data kelas baru
    public function create()
    {
        $students = Student::all(); // Menampilkan semua siswa
        return view('classes.create', compact('students'));
    }

    // Menyimpan data kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_name' => 'required|string|max:255',
        ]);

        ClassModel::create([
            'student_id' => $request->student_id,
            'class_name' => $request->class_name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    // Menampilkan detail data kelas berdasarkan ID
    public function show($id)
    {
        $class = ClassModel::with('students')->findOrFail($id); // Mengambil data kelas dengan relasi siswa
        return view('classes.show', compact('class'));
    }

    // Menampilkan form untuk mengedit data kelas
    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $students = Student::all(); // Menampilkan semua siswa
        return view('classes.edit', compact('class', 'students'));
    }

    // Mengupdate data kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_name' => 'required|string|max:255',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->update([
            'student_id' => $request->student_id,
            'class_name' => $request->class_name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui');
    }

    // Menghapus data kelas
    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus');
    }
}

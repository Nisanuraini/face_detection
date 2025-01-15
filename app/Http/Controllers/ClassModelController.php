<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    public function index()
    {
        $classes = Classroom::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.classes.create', compact('students'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        Classroom::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function show($id)
    {
        $classroom = Classroom::find($id);
        $classroom->load('students');

        if (!$classroom) {
            return redirect()->route('classes.index')
                ->with('error', 'Kelas tidak ditemukan.');
        }

        return view('admin.classes.show', compact('classroom'));
    }

    public function edit($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            return redirect()->route('classes.index')
                ->with('error', 'Kelas tidak ditemukan.');
        }

        $students = Student::all();
        return view('admin.classes.edit', compact('classroom', 'students'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        // Update data
        $class = Classroom::find($id);
        if (!$class) {
            return redirect()->route('classes.index')
                ->with('error', 'Kelas tidak ditemukan.');
        }

        $class->update($request->all());

        // Redirect dengan notifikasi
        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $class = Classroom::find($id);
        if (!$class) {
            return redirect()->route('classes.index')
                ->with('error', 'Kelas tidak ditemukan.');
        }

        $class->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}

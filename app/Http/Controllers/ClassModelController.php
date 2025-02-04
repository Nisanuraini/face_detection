<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\School;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    public function index()
    {
        $classes = Classroom::all();
        $schools = School::all();
        return view('admin.classes.index', compact('classes', 'schools'));
    }

    public function create()
    {
        $schools = School::all();
        return view('admin.classes.create', compact('schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ]);

        Classroom::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $classroom = Classroom::with('school', 'students')->findOrFail($id);
        return view('admin.classes.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        $schools = School::all();
        return view('classes.edit', compact('classroom', 'schools'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
}

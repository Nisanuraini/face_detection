<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    public function index()
    {
        $schools = School::all();
        $classes = Classroom::all();
        return view('admin.classes.index', compact('classes', 'schools'));
    }

    public function create()
    {   
        return view('admin.classes.create');
    }

    public function store(Request $request)
    { 
        $request->validate([
            'class_name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ]);

        Classroom::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function show($id)
    {
        $classroom = Classroom::with('school', 'students')->findOrFail($id);        
        return view('admin.classes.show', compact('classroom'));
    }

    public function edit($id)
    {
        $schools = School::all();
        $classroom = Classroom::findOrFail($id);
        return view('admin.classes.edit', compact('classroom'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'school_id' => 'required',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->only('class_name'));

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
}

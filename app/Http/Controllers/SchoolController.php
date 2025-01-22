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
        return view('admin.schools.index', compact('schools'));
    }
    
    public function create()
    {
        return view('admin.schools.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        School::create($request->only(['name']));
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }
    
    public function show(School $school)
    {
        $school = School::with('classes')->findOrFail($school->id);
        return view('admin.schools.show', compact('school'));
    }
    
    public function edit(School $school)
    {
        return view('admin.schools.edit', compact('schools'));
    }
    
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $school->update($request->only(['name']));
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil diperbarui.');
    }
    
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil dihapus.');
    }
}

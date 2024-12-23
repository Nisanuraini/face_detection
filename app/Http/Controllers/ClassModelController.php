<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    public function index()
    {
        $classes = Classroom::with('students')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.classes.create', compact('students'));
    }

    public function store(Request $request)
    {
        $classes = Classroom::create($request->all());
        return redirect()->route('classes.index');
    }

    public function show($id)
    {
        $classes = Classroom::find($id);
        return view('admin.classes.show', compact('class'));
    }

    public function edit($id)
    {
        $classes = Classroom::find($id);
        $students = Student::all();
        return view('admin.classes.edit', compact('class', 'students'));
    }

    public function update(Request $request, $id)
    {
        $classes = Classroom::find($id);
        $classes->update($request->all());
        return redirect()->route('classes.index');
    }

    public function destroy($id)
    {
        ClassModel::destroy($id);
        return redirect()->route('classes.index');
    }
}

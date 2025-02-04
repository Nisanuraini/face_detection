<?php

namespace App\Http\Controllers;

use App\Models\ListFaceDetection;
use App\Models\Student;
use Illuminate\Http\Request;

class ListFaceDetectionController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $listFaceDetections = ListFaceDetection::with('student')->get();
        return view('admin.listfacedetections.index', compact('listFaceDetections', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.listfacedetections.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'pickup_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        if ($request->hasFile('pickup_image')) {
            $validated['pickup_image'] = $request->file('pickup_image')->store('pickups', 'public');
        }

        ListFaceDetection::create($validated);

        return redirect()->route('listfacedetections.index')->with('success', 'Data penjemputan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $listFaceDetection = ListFaceDetection::with('student')->findOrFail($id);
        return view('admin.listfacedetections.show', compact('listFaceDetection'));
    }

    public function edit(ListFaceDetection $listFaceDetection)
    {
        $students = Student::all();
        return view('admin.listfacedetections.edit', compact('listFaceDetection', 'students'));
    }

    public function update(Request $request, ListFaceDetection $listFaceDetection)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'pickup_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        if ($request->hasFile('pickup_image')) {
            $validated['pickup_image'] = $request->file('pickup_image')->store('pickups', 'public');
        }

        $listFaceDetection->update($validated);

        return redirect()->route('listfacedetections.index')->with('success', 'Data penjemputan berhasil diperbarui.');
    }

    public function destroy(ListFaceDetection $listFaceDetection)
    {
        $listFaceDetection->delete();
        return redirect()->route('listfacedetections.index')->with('success', 'Data penjemputan berhasil dihapus.');
    }
}
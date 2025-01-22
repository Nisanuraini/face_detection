<?php

namespace App\Http\Controllers;

use App\Models\PickupStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class PickupStudentController extends Controller
{
    // Display a listing of the pickup records
    public function index()
    {
        $pickups = PickupStudent::with('student')->get();
        return view('admin.pickupstudents.index', compact('pickups'));
    }

    // Show the form for creating a new pickup record
    public function create()
    {
        $students = Student::all();
        return view('admin.pickupstudents.create', compact('students'));
    }

    // Store a newly created pickup record in the database
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_nama' => 'required|string|max:255',
        ]);

        PickupStudent::create($request->all());

        return redirect()->route('pickupstudents.index')->with('success', 'Data penjemputan berhasil ditambahkan.');
    }

    // Display the specified pickup record
    public function show(PickupStudent $pickupStudent)
    {
        return view('admin.pickupstudents.show', compact('pickupStudent'));
    }

    // Show the form for editing the specified pickup record
    public function edit(PickupStudent $pickupStudent)
    {
        $students = Student::all();
        return view('pickupstudents.edit', compact('pickupStudent', 'students'));
    }

    // Update the specified pickup record in the database
    public function update(Request $request, PickupStudent $pickupStudent)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_nama' => 'required|string|max:255',
        ]);

        $pickupStudent->update($request->all());

        return redirect()->route('pickupstudents.index')->with('success', 'Data penjemputan berhasil diperbarui.');
    }

    // Remove the specified pickup record from the database
    public function destroy(PickupStudent $pickupStudent)
    {
        $pickupStudent->delete();

        return redirect()->route('pickupstudents.index')->with('success', 'Data penjemputan berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Student;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $pickups = Pickup::with('student')->get();
        return view('admin.pickups.index', compact('pickups', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.pickups.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'=> 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
        ]);

        Pickup::create($validated);
        return redirect()->route('pickups.index')->with('success', 'Data penjemputan berhasil ditambahkan.');
    }

    public function show(Pickup $pickup)
    {
        $pickup = Pickup::with('student')->findOrFail($pickup->id);
        return view('admin.pickups.show', compact('pickup'));
    }

    public function edit(Pickup $pickup)
    {
        $students = Student::all();
        return view('admin.pickups.edit', compact('pickup', 'students'));
    }

    public function update(Request $request, Pickup $pickup)
    {
        $validated = $request->validate([
            'student_id'=> 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
        ]);

        $pickup->update($validated);
        return redirect()->route('pickups.index')->with('success', 'Data penjemputan berhasil diperbarui.');
    }

    public function destroy(Pickup $pickup)
    {
        $pickup->delete();
        return redirect()->route('pickups.index')->with('success', 'Data penjemputan berhasil dihapus.');
    }
}
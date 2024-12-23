<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::with('student')->get();
        return view('admin.pickups.index', compact('pickups'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.pickups.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'pickup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $data = $request->all();
        if ($request->hasFile('pickup_image')) {
            $data['pickup_image'] = $request->file('pickup_image')->store('pickup_images', 'public');
        }

        Pickup::create($data);

        return redirect()->route('pickups.index')->with('success', 'Pickup created successfully.');
    }

    public function show(Pickup $pickup)
    {
        return view('admin.pickups.show', compact('pickup'));
    }

    public function edit(Pickup $pickup)
    {
        $students = Student::all();
        return view('admin.pickups.edit', compact('pickup', 'students'));
    }

    public function update(Request $request, Pickup $pickup)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'pickup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $data = $request->all();
        if ($request->hasFile('pickup_image')) {
            if ($pickup->pickup_image) {
                Storage::disk('public')->delete($pickup->pickup_image);
            }
            $data['pickup_image'] = $request->file('pickup_image')->store('pickup_images', 'public');
        }

        $pickup->update($data);

        return redirect()->route('pickups.index')->with('success', 'Pickup updated successfully.');
    }

    public function destroy(Pickup $pickup)
    {
        if ($pickup->pickup_image) {
            Storage::disk('public')->delete($pickup->pickup_image);
        }
        $pickup->delete();

        return redirect()->route('admin.pickups.index')->with('success', 'Pickup deleted successfully.');
    }
}

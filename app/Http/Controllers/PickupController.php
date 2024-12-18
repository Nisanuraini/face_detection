<?php

namespace App\Http\Controllers;

use App\Models\PickUp;
use App\Models\Student;
use Illuminate\Http\Request;

class PickUpController extends Controller
{
    // Menampilkan semua data penjemputan
    public function index()
    {
        $pickups = PickUp::with('students')->get(); // Mengambil data pickup dengan relasi siswa
        return view('pickups.index', compact('pickups'));
    }

    // Menampilkan form untuk membuat data penjemputan baru
    public function create()
    {
        $students = Student::all(); // Menampilkan semua siswa
        return view('pickups.create', compact('students'));
    }

    // Menyimpan data penjemputan baru
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'face_detection' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        PickUp::create([
            'student_id' => $request->student_id,
            'pickup_name' => $request->pickup_name,
            'face_detection' => $request->face_detection,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('pickups.index')->with('success', 'Penjemputan berhasil ditambahkan');
    }

    // Menampilkan detail data penjemputan berdasarkan ID
    public function show($id)
    {
        $pickup = PickUp::with('students')->findOrFail($id); // Mengambil data pickup dengan relasi siswa
        return view('pickups.show', compact('pickup'));
    }

    // Menampilkan form untuk mengedit data penjemputan
    public function edit($id)
    {
        $pickup = PickUp::findOrFail($id);
        $students = Student::all(); // Menampilkan semua siswa
        return view('pickups.edit', compact('pickup', 'students'));
    }

    // Mengupdate data penjemputan
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'pickup_name' => 'required|string|max:255',
            'face_detection' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $pickup = PickUp::findOrFail($id);
        $pickup->update([
            'student_id' => $request->student_id,
            'pickup_name' => $request->pickup_name,
            'face_detection' => $request->face_detection,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('pickups.index')->with('success', 'Penjemputan berhasil diperbarui');
    }

    // Menghapus data penjemputan
    public function destroy($id)
    {
        $pickup = PickUp::findOrFail($id);
        $pickup->delete();

        return redirect()->route('pickups.index')->with('success', 'Penjemputan berhasil dihapus');
    }
}

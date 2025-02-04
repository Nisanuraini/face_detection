<?php


namespace App\Http\Controllers;


use App\Models\FaceDetection;
use Illuminate\Http\Request;


use App\Models\Classroom;
use App\Models\Student;


class FaceDetectionController extends Controller
{
    public function index()
    {
        return view('admin.face-detection.index');
    }


    public function getData()
    {
        $classes = Classroom::all(); // Ambil semua data kelas
        $students = Student::all(); // Ambil semua data siswa


        return response()->json([
            'classes' => $classes,
            'students' => $students,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image',
            'date_time' => 'required|date',
            'student_id' => 'required|exists:students,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $photoPath = $request->file('photo')->store('photos', 'public');

        FaceDetection::create([
            'photo' => $photoPath,
            'date_time' => now(),
            'student_id' => $request->student_id,
            'classroom_id' => $request->classroom_id,
        ]);

        return redirect()->back()->with('success', 'Face detection data saved successfully.');
    }
}

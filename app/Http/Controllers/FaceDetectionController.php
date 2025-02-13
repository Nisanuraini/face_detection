<?php


namespace App\Http\Controllers;


use App\Models\FaceDetection;
use App\Models\ListFaceDetection;
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
        'image' => 'required',
        'student_id' => 'required|exists:students,id',
        'class_id' => 'required|exists:classes,id',
    ]);

    $imageData = $request->image; 
    $image = str_replace('data:image/png;base64,', '', $imageData);
    $image = str_replace(' ', '+', $image);
    $imageName = 'penjemputan_' . time() . '.png';

    Storage::disk('public')->put('penjemputan/' . $imageName, base64_decode($image));

    FaceDetection::create([
        'student_id' => $request->student_id,
        'class_id' => $request->class_id,
        'image' => 'penjemputan/' . $imageName
    ]);

    return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'photo' => 'required|string',
            'student_id' => 'required|integer',
            'classroom_id' => 'required|integer',
        ]);

        $data['date_time'] = now();

        FaceDetection::create($data);

        return response()->json(['message' => 'Face detection berhasil dikirim!']);
    }
}
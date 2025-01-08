<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceDetectionController extends Controller
{
    public function index()
    {
        return view('admin.face-detection.index'); // Ganti dengan nama view yang sesuai
    }
}

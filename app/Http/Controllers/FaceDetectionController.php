<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceDetectionController extends Controller
{
    public function show($id)
    {
        $pickup = Pickup::findOrFail($id);
        return view('admin.face-detection-result', compact('pickup'));
    }
}

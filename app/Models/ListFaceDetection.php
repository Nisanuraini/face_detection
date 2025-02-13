<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListFaceDetection extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'pickup_name',
        'pickup_image',
        'date',
        'time',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

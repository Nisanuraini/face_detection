<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUp extends Model
{
    protected $table = 'pickups';

    protected $fillable = [
        'student_id',
        'pickup_name',
        'face_detection',
        'date',
        'time'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}

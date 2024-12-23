<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\School;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $fillable = ['class_name', 'student_id'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function school()
    {
        return $this->hasOne(School::class);
    }
}



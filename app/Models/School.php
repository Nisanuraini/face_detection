<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;
use App\Models\Student;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $fillable = [
        'name',
        'student_id',
        'class_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }  
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }  
}

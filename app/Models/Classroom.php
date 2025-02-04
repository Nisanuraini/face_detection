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
    
    protected $fillable = [
        'id',
        'class_name',
        'school_id'
    ];
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id'); 
    }

}
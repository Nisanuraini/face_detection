<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['class_name', 'school_id']; 
    
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id'); 
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'classroom_id');   
    }
}

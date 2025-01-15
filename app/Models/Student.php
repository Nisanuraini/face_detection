<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    // Kolom-kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'name',
        'nis',
        'class_id',
        'address',
        'parent_name',
        'parent_contact',
        'emergency_contact',
        'pickup_person',
        'student_image', 
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function pickup()
    {
        return $this->hasOne(Pickup::class, 'student_id');
    }
}

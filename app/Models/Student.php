<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'nis',
        'classroom_id',
        'school_id',
        'address',
        'parent_name',
        'parent_contact',
        'emergency_contact',
        'pickup_name',
        'photo',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // Relasi ke Pickup
    public function pickup()
    {
        return $this->hasOne(Pickup::class, 'student_id');
    }

    public function pickupStudent()
    {
        return $this->hasOne(PickupStudent::class, 'student_id');
    }
}
 
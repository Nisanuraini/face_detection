<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name', 
        'nis', 
        'class_id', 
        'school_id', 
        'alamat', 
        'nama_orangtua', 
        'kontak_orangtua', 
        'kontak_darurat', 
        'nama_penjemput', 
        'student_image' 
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id'); 
    }

    public function school()
    {
        return $this->belongsTo(School::class); 
    }

    public function pickups ()
    {
        return $this->hasMany(Pickup::class);
    }
}
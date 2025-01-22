<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $fillable = [
        'name',
    ];

    public function classes()
    {
        return $this->hasMany(Classroom::class, 'school_id'); // 1 sekolah memiliki banyak kelas
    }

    public function students()
    {
        return $this->hasMany(Student::class, Classroom::class, 'school_id', 'classroom_id');
    }
}


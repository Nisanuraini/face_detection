<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupStudent extends Model
{
    use HasFactory;
    protected $table = 'pickup_students';

    protected $fillable = [
        'pickup_nama',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}

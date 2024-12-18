<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable =['student_id', 'class name'];

    public function students(){
        return $this->belongsTo(Student::class);
    }
}

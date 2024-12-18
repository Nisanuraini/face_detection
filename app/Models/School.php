<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    
    protected $fillable = [
        'name',
        'student_id', 
        'class_id'
    ];
    
    public function classes (){
        return $this->belongsTo(Kelas::class);
    }
}

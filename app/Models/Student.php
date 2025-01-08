<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['name', 'nis'];

    public function classroom (){
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function pickup (){
        return $this->hasMany(Pickup::class);
    }
}

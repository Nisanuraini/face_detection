<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['name', 'nis'];

    public function classes (){
        return $this->hasMany(Kelas::class);
    }

    public function pickups (){
        return $this->hasMany(Pickup::class);
    }
}

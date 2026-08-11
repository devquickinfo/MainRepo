<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'class_id',
        'school_id',
        'name'
    ];

    

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class,'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

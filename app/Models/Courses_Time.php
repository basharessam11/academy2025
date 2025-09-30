<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses_Time extends Model
{
    protected $table = 'courses_times';
    use HasFactory;
    protected $guarded = [];


    public function course()  {
        return $this->belongsTo(Courses::class,'course_id');
    }
}

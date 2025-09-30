<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesDescription extends Model
{
    protected $guarded = [];
    public function course()  {
        return $this->belongsTo(Courses::class,'course_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $guarded = [];

    public function group()  {
        return $this->belongsTo(Group::class,'group_id');
    }

    public function files()  {
        return $this->hasMany(LectureFile::class,'lecture_id');
    }

}

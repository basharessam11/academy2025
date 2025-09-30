<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureFile extends Model
{
    protected $guarded = [];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}

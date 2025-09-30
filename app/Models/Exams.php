<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $guarded = [];
// Exam.php
public function answers()
{
    return $this->hasMany(Answers::class,'exam_id');
}

}

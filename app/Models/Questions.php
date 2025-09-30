<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }

    public function options ()
    {
        return $this->hasMany(QuestionOptions::class, 'question_id');
    }
}

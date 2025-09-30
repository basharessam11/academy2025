<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }
}

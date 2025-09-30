<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $guarded = [];
    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }


}

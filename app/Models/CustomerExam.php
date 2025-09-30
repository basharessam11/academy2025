<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExam extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }
    
}

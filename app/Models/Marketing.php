<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    protected $table = 'marketing'; // تحديد اسم الجدول يدوي

    protected $fillable = ['name','location','phone','contact_method','education','user_id','note','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

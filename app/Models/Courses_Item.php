<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Courses_Item extends Model
{
    use HasFactory;
    protected $table = 'courses_items';
    protected $guarded = [];
    public function courses()
    {
        return $this->belongsTo(Courses::class );
    }
}

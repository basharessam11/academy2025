<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('booking', 'booking'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('booking', 'booking');
        } else {
            $this->attributes['photo'] = $value;
        }
    }
}

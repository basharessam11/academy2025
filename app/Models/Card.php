<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('card', 'card'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('card', 'card');
        } else {
            $this->attributes['photo'] = $value;
        }
    }
}

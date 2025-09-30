<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setImageAttribute($value)
    {


        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        $value[1] => $file->store('story', 'story'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes[$value[1]] = $value->store('story', 'story');
        } else {
            $this->attributes[$value[1]] = $value;
        }
    }
}

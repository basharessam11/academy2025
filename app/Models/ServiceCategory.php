<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $guarded = [];


    public function course()  {
        return $this->hasMany(Courses::class,'category_id');
    }

    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('ServiceCategory', 'ServiceCategory'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('ServiceCategory', 'ServiceCategory');
        } else {
            $this->attributes['photo'] = $value;
        }
    }
}

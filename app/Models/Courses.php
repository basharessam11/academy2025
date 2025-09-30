<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Courses extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];



 
    public static function boot()
    {
        parent::boot();

        // عند حفظ المنتج (إضافة أو تعديل)
        static::saving(function ($courses) {
             if (!$courses->slug) {
                $courses->slug_ar = str_replace(' ', '-', $courses->title_ar) . '-' . $courses->id;
                $courses->slug_en = Str::slug($courses->title_en . '-' . $courses->id);
            } else {
                $courses->slug_ar = str_replace(' ', '-', $courses->title_ar) . '-' . $courses->id;


                $courses->slug_en = Str::slug($courses->title_en . '-' . $courses->id);
            }
        });
    }




    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('courses', 'courses'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('courses', 'courses');
        } else {
            $this->attributes['photo'] = $value;
        }
    }

    public function review()  {
        return $this->hasMany(Courses_Review::class,'course_id');

    }

    public function items()  {
        return $this->hasMany(Courses_Item::class,'course_id');

    }

    public function coursesDescription()  {
        return $this->hasMany(CoursesDescription::class,'course_id');

    }
    public function times()  {
        return $this->hasMany(Courses_Time::class,'course_id');

    }
    public function user()
    {
        return $this->belongsTo(User::class );
    }
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class );
    }
}

<?php

namespace App\Models;

use App\Models\Admin\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('service', 'service'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('service', 'service');
        } else {
            $this->attributes['photo'] = $value;
        }
    }




    public function category()
    {
        return $this->belongsTo(ServiceCategory::class );
    }
}

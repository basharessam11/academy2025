<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $guarded = [];

    public function setImageAttribute($value)
    {


        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        $value[1] => $file->store('expenses', 'expenses'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes[$value[1]] = $value->store('expenses', 'expenses');
        } else {
            $this->attributes[$value[1]] = $value;
        }
    }
}



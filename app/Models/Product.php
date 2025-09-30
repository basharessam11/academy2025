<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        // عند حفظ المنتج (إضافة أو تعديل)
        static::saving(function ($product) {
             if (!$product->slug) {
                $product->slug_ar = Str::slug($product->title_ar . '-' . $product->id);
                $product->slug_en = Str::slug($product->title_en . '-' . $product->id);
            } else {
                $product->slug_ar = Str::slug($product->title_ar . '-' . $product->id);
                $product->slug_en = Str::slug($product->title_en . '-' . $product->id);
            }
        });
    }



    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('product', 'product'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('product', 'product');
        } else {
            $this->attributes['photo'] = $value;
        }
    }

    public function review()  {
        return $this->hasMany(Review::class,'product_id');

    }

}

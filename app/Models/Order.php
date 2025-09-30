<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order_pro()  {
        return $this->hasMany(Order_Pro::class,'order_id');

    }


    public function country()  {
        return $this->belongsTo(Country::class,'country_id');
    }

}

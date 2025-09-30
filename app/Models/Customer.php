<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


 use Laravel\Sanctum\HasApiTokens;
 class Customer extends Authenticatable
 {
     use HasApiTokens, Notifiable;

    use HasFactory;

    protected $guarded = [];




    protected $guard = 'customer';


    protected $hidden = ['password', 'remember_token'];







    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('customer', 'customer'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('customer', 'customer');
        } else {
            $this->attributes['photo'] = $value;
        }
    }




    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }


    public function customerexam()
    {
        return $this->hasMany(CustomerExam::class);
    }





    public function product()  {
        return $this->belongsTo(Product::class,'product_id');
    }


    public function order()
    {
        return $this->hasMany(Order::class);

    }

    // public function visa()
    // {
    //     return $this->hasMany(Visa::class);
    // }

    public function orders()  {
        return $this->hasMany(Order::class,'customer_id');

    }

    public function booking()  {
        return $this->hasMany(Booking::class,'customer_id');

    }

    public function order_pro()  {
        return $this->hasMany(Order_Pro::class,'customer_id');

    }

    public function country()  {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function group()  {
        return $this->belongsTo(Group::class,'group_id');
    }

}

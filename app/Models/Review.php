<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'rate',
        'review',
        'ip_address',
        'name',
        'email',
    ];

    public function product()  {
        return $this->belongsTo(Product::class,'product_id');
    }
public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

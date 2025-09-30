<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    // داخل موديل Group
// Group.php
public function customer()
{
    return $this->hasMany(Customer::class, 'group_id');
    // أو hasMany إذا فيه أكثر من عميل لنفس الجروب
}



}

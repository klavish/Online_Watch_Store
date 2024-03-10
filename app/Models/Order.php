<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'sub_total',
        'shipping',
        'tax_amount',
        'tax_rate',
        'amount',
        'comment',
        'status',
    ];

    public function customerData(){
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'fname', 'lname');
    }

    public function lineitemsData(){
        return $this->hasMany(Lineitem::class, 'order_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    // const BRAND_ACTIVE = 1;
    // const BRAND_DEACTIVE = 0;

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];
}

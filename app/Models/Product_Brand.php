<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Brand extends Model
{
    use HasFactory;

    protected $table = 'product_brand';

    protected $fillable = [
        'product_brand_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_brand_id');
    }
}
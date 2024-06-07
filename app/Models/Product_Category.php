<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'product_category_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public function specs()
    {
        return $this->hasMany(Product_Spec::class, 'product_spec_cat');
    }
}
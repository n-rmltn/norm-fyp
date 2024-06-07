<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Spec extends Model
{
    use HasFactory;

    protected $table = 'product_spec';

    protected $fillable = [
        'product_spec_cat',
        'product_spec_name',
    ];

    public function category()
    {
        return $this->belongsTo(Product_Category::class, 'product_spec_cat');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_spec_id');
    }
}
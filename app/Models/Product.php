<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'product_name',
        'product_brand_id',
        'product_category_id',
        'product_spec_id',
        'product_cart_image_name',
        'product_description',
        'product_base_price',
        'product_quantity',
        'product_availability',
    ];

    public function brand()
    {
        return $this->belongsTo(Product_Brand::class, 'product_brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Product_Category::class, 'product_category_id');
    }

    public function spec()
    {
        return $this->belongsTo(Product_Spec::class, 'product_spec_id');
    }

}

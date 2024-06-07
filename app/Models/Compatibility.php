<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compatibility extends Model
{
    use HasFactory;

    protected $table = 'compatibility';

    protected $fillable = [
        'motherboard',
        'cpu',
        'ram',
    ];

    public function motherboardSpec()
    {
        return $this->belongsTo(Product_Spec::class, 'motherboard');
    }

    public function cpuSpec()
    {
        return $this->belongsTo(Product_Spec::class, 'cpu');
    }

    public function ramSpec()
    {
        return $this->belongsTo(Product_Spec::class, 'ram');
    }
}

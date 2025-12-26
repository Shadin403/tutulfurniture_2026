<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'material',
        'dimensions',
        'weight',
        'size',
        'color',
        'short_description',
        'description',
        'regular_price',
        'discount_price',
        'discount_time',
        'extra_info',
        'warranty',
        'assembly_required',
        'indoor_outdoor',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'dimensions' => 'array', // JSON ডাটা array হিসেবে সংরক্ষণ হবে
        'size' => 'array',
    ];

    // protected $attributes = [
    //     'assembly_required' => false
    // ];

    // Product সম্পর্ক
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

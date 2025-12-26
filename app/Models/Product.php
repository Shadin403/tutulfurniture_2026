<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'SKU',
        'stock_status',
        'quantity',
        'image',
        'gallery_images',
        'category_id',
        'brand_id',
        'featured',
        'tags',
        'views',
        'is_active'
    ];



    protected $casts = [
        'tags' => 'array',
        'gallery_images' => 'array',
    ];

    // Category সম্পর্ক
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Brand সম্পর্ক
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // ProductDetail সম্পর্ক
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    //SubCategory সম্পর্ক
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

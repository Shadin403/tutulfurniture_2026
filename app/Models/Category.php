<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable =  ['name', 'slug', 'image', 'brand_id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // public function brand() {
    //     return $this->belongsTo(Brand::class);
    // }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}

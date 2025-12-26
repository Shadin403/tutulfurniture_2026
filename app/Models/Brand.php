<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable =  ['name', 'slug', 'image'];
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // public function category() {
    //     return $this->hasMany(Category::class);
    // }
}

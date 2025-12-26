<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductDetail as ModelsProductDetail;

class Productdetail extends Component
{
    public $product_id;
    public $Product_name;
    public $slug;
    public $SKU;
    public $quantity;
    public $stock_status;
    public $category_id;
    public $sub_category_id;
    public $brand_id;
    public $created_at;
    public $updated_at;
    public $product_image;
    public $product_gallery_images = [];


    // Brand
    public $brand_name;

    // Category
    public $category_name;

    // Sub Category
    public $sub_category_name;

    // Product Details
    public $material;
    public $dimensions = [
        'length' => '',
        'width' => '',
        'height' => '',
    ];
    public $weight;
    public $color;
    public $short_description;
    public $description;
    public $regular_price;
    public $discount_price;
    public $size;
    public $extra_info;
    public $discount_time;

    public function mount($id)
    {

        $this->product_id = $id;
        $productDetail = ModelsProductDetail::where('product_id', $this->product_id)->first();
        $product = Product::find($this->product_id);
        $brand = Brand::find($product->brand_id);
        $category = Category::find($product->category_id);
        $subCategory = SubCategory::find($product->sub_category_id);

        // dd($subCategory, $category, $brand);

        if ($productDetail) {
            $this->Product_name = $product->name;
            $this->product_image = $product->image;
            // $this->product_gallery_images = $product->gallery_images ?? [];
            $this->slug = $product->slug;
            $this->quantity = $product->quantity;
            $this->stock_status = $product->stock_status;
            $this->SKU = $product->SKU;
            $this->created_at = $product->created_at;
            $this->updated_at = $product->updated_at;

            // Brand
            $this->brand_name = $brand->name;

            // Category
            $this->category_name = $category->name;

            // Sub Category
            $this->sub_category_name = $subCategory->name;
            // Product Details
            $this->material = $productDetail->material;


            foreach ($productDetail->dimensions as $key => $value) {
                $this->dimensions[$key] = $value;
            }

            // dd($this->dimensions);


            $this->weight = $productDetail->weight;
            $this->color = $productDetail->color;
            $this->short_description = $productDetail->short_description;
            $this->description = $productDetail->description;
            $this->regular_price = $productDetail->regular_price;
            $this->discount_price = $productDetail->discount_price;
            $this->size = $productDetail->size;
            $this->extra_info = $productDetail->extra_info;
            $this->discount_time = $productDetail->discount_time;
        }
    }

    #[On('deleteProduct')]
    public function deleteProduct($id)
    {
        $product = Product::find($id);



        if (!$product) {
            session()->flash('error', 'Product not found');
            return;
        }
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->gallery_images) {
            $galleryImages = $product->gallery_images;
            foreach ($galleryImages as $image) {
                if (Storage::disk('public')->exists('uploads/products/gallery/' . $image)) {
                    Storage::disk('public')->delete('uploads/products/gallery/' . $image);
                }
            }
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        $this->redirect(route('admin.all.products'), navigate: true);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.product.productdetail');
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use App\Models\ProductDetail;
use App\Models\Review;
use Livewire\WithPagination;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Productdetails extends Component
{
    use WithPagination;
    public $product_id, $Product_name, $slug, $SKU, $quantity, $stock_status;
    public $category_id, $sub_category_id, $brand_id, $created_at, $updated_at;
    public $product_image, $product_gallery_images = [], $tags = [];
    public $selectedImage;

    public $all_reviews, $reviews_count;


    //reviews save
    public $rating = 0, $review;

    // Brand
    public $brand_name;

    // Category
    public $category_name;

    // Sub Category
    public $sub_category_name;

    // Product Details
    public $materials,  $weight, $color, $short_description, $description;
    public $regular_price, $discount_price, $size, $extra_info, $discount_time;

    public $dimensions = [
        'length' => '',
        'width' => '',
        'height' => '',
    ];
    public $related_products = [];

    public $quantityInCart = 1;







    public function mount($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $this->related_products = Product::with('productDetail')->where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();


        if (!$product) {
            abort(404);
        }

        $this->product_id = $product->id;
        $this->Product_name = $product->name;
        $this->slug = $product->slug;
        $this->SKU = $product->SKU;
        $this->quantity = $product->quantity;
        $this->stock_status = $product->stock_status;
        $this->category_id = $product->category_id;
        $this->sub_category_id = $product->sub_category_id;
        $this->brand_id = $product->brand_id;
        $this->tags = $product->tags;
        $this->created_at = $product->created_at;
        $this->updated_at = $product->updated_at;

        // single image path
        $this->product_image = $product->image;

        // gallery images path
        $this->product_gallery_images = $product->gallery_images ?? [];


        // Brand
        $brand = Brand::find($product->brand_id);
        $this->brand_name = optional($brand)->name;

        // Category
        $category = Category::find($product->category_id);
        $this->category_name = optional($category)->name;

        // Sub Category
        $sub_category = SubCategory::find($product->sub_category_id);
        $this->sub_category_name = optional($sub_category)->name;

        // Product Details
        $product_details = ProductDetail::where('product_id', $product->id)->first();
        $this->materials = optional($product_details)->material;
        if ($product_details->dimensions) {
            foreach ($product_details->dimensions as $key => $value) {
                $this->dimensions[$key] = $value;
            }
        }
        $this->weight = optional($product_details)->weight;
        $this->color = optional($product_details)->color;
        $this->short_description = optional($product_details)->short_description;
        $this->description = optional($product_details)->description;
        $this->regular_price = optional($product_details)->regular_price;
        $this->discount_price = optional($product_details)->discount_price;
        $this->size = optional($product_details)->size;
        $this->extra_info = optional($product_details)->extra_info;
        $this->discount_time = optional($product_details)->discount_time;

        $this->all_reviews = Review::where('product_id', $product->id)->get();
        // dd($this->reviews);
        $this->reviews_count = Review::where('product_id', $product->id)->count();
    }

    // public function updated($propertyName)
    // {
    //     // যখন কিছু পরিবর্তন হবে, Fancybox ইভেন্ট ডিপ্যাচ হবে
    //     $this->dispatchBrowserEvent('load-fancybox');
    // }


    public function render()
    {
        $reviews = Review::orderBy('id', 'desc')->where('product_id', $this->product_id)->paginate(10);
        return view(
            'livewire.pages.productdetails',
            [
                'reviews' => $reviews
            ]
        )->layout('components.layouts.app');
    }



    public function addToCart($product_id)
    {
        $product = Product::find($product_id);
        $product_details = $product->productDetail;



        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }

        // dd($product);
        if ($product) {
            Cart::instance('cart')
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => $this->quantityInCart, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('cart_updated');
        $this->dispatch('success', 'Product added to cart successfully.');
    }


    //! add to wishlist function
    public function addToWishlist($product_id)
    {
        $product = Product::find($product_id);
        $product_details = $product->productDetail;



        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }

        if ($product) {
            Cart::instance('wishlist')
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('wishlist_updated');
        $this->dispatch('alert-success', 'Product added to wishlist successfully.');
    }

    //! remove to wishlist function
    public function removeFromWishlist($product_id)
    {

        Cart::instance('wishlist')->remove($product_id);
        $this->dispatch('wishlist_updated');
        $this->dispatch('alert-warning', 'Product removed from wishlist successfully.');
    }


    public function reviewSave()
    {

        // dd($this->rating);
        $this->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        Review::create([
            'product_id' => $this->product_id,
            'user_id' => auth()->user()->id,
            'rating' => $this->rating,
            'review' => $this->review
        ]);

        $this->rating = 0;
        $this->review = null;
        $this->dispatch('alert-success', 'Review added successfully.');
        $this->dispatch('scroll-to-review');
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Slide as SlideModel;
use App\Models\SubCategory;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Home extends Component
{
    public $sliders = [];


    public function render()
    {


        $categories = Category::with('subCategories')->get();
        $subcategories = SubCategory::select('id', 'name', 'image')->get();
        $products = Product::with('productDetail')->orderBy('id', 'desc')->paginate(5);
        $featured_products = Product::with('productDetail')->where('featured', 1)->orderBy('id', 'desc')->paginate(5);
        $new_arrivals = Product::with('productDetail')->whereRaw("DATE_ADD(created_at, INTERVAL 7 DAY) >= NOW()")->orderBy('id', 'desc')->get();
        $this->sliders = SlideModel::where('status', 1)->take(3)->get();
        // dd($this->sliders);

        return view('livewire.pages.home', [

            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'featured_products' => $featured_products,
            'new_arrivals' => $new_arrivals,

        ]);
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
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('cart_updated');
    }


    // public function addToWishlist($product_id)
    // {
    //     $product = Product::find($product_id);
    //     $product_details = $product->productDetail;

    //     if ($product_details->discount_price) {
    //         $price = $product_details->discount_price;
    //     } else {
    //         $price = $product_details->regular_price;
    //     }

    //     if ($product) {
    //         Cart::instance('wishlist')
    //             ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
    //                 'image' => $product->image,
    //                 'slug' => $product->slug,
    //             ]])
    //             ->associate('App\Models\Product');
    //     }

    //     $this->dispatch('wishlist_updated');
    //     $this->dispatch('wishlist-added-home');
    // }

    // public function removeFromWishlist($product_id)
    // {
    //     Cart::instance('wishlist')->remove($product_id);
    //     $this->dispatch('wishlist_updated');
    //     $this->dispatch('wishlist-removed-home');
    // }

    public function addToWishlistFeatured($product_id)
    {
        $product = Product::find($product_id);
        $product_details = $product->productDetail;

        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }

        if ($product) {
            $this->dispatch('wishlist-added-home');
            Cart::instance('wishlist')
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('alert-success', 'Product added to wishlist successfully.');
    }

    public function removeFromWishlistFeatured($product_id)
    {
        $this->dispatch('wishlist-removed-home');
        Cart::instance('wishlist')->remove($product_id);
        $this->dispatch('alert-warning', 'Product removed from wishlist successfully.');
    }
}

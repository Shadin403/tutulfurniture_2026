<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Wishlist extends Component
{

    public $search = '';





    public function render()
    {


        $wishlists = Cart::instance('wishlist')->content();
        $filtered =  $wishlists->filter(function ($item) {
            return str_contains(strtolower($item->name), strtolower($this->search));
        });
        // dd($wishlists);


        return view('livewire.pages.wishlist', [
            'wishlists' => $filtered
        ]);
    }




    public function removeFromWishlist($product_id)
    {
        Cart::instance('wishlist')->remove($product_id);
        $this->dispatch('wishlist_updated');
        $this->dispatch('alert-warning', 'Product removed from wishlist successfully.');
    }

    public function removeAllWishlist()
    {
        Cart::instance('wishlist')->destroy();
        $this->dispatch('wishlist_updated');
        $this->dispatch('success', 'Wishlist cleared successfully.');
    }

    public function moveToCart($product_id)
    {
        $product = Cart::instance('wishlist')->get($product_id);
        Cart::instance('wishlist')->remove($product_id);
        Cart::instance('cart')->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'options' => [
            'image' => $product->options->image,
            'slug' => $product->options->slug,
        ]])
            ->associate('App\Models\Product');
        $this->dispatch('wishlist_updated');
        $this->dispatch('cart_updated');
        $this->dispatch('alert-success', 'Product moved to cart successfully.');
    }
}

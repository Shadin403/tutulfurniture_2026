<?php

namespace App\Livewire\Pages;

use App\Models\Address;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Surfsidemedia\Shoppingcart\Facades\Cart as FacadesCart;

class Cart extends Component
{




    public function mount()
    {
        sleep(1);
    }


    public function increment($rowId)
    {
        $product = FacadesCart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        FacadesCart::instance('cart')->update($rowId, [
            'qty' => $qty
        ]);
        $this->dispatch('cart_updated');
    }


    public function decrement($rowId)
    {
        $product = FacadesCart::instance('cart')->get($rowId);

        if ($product->qty > 1) {
            $qty = $product->qty - 1;
            FacadesCart::instance('cart')->update($rowId, [
                'qty' => $qty
            ]);
        }
        $this->dispatch('cart_updated');
    }




    public function removeItem($rowId)
    {
        $product = FacadesCart::instance('cart')->get($rowId);
        FacadesCart::instance('cart')->remove($rowId);
        $this->dispatch('cart_updated');
        session()->flash('success', ' removed from cart.');

        $this->dispatch('session-updated-success');
    }


    public function removeAllCart()
    {
        FacadesCart::instance('cart')->destroy();
        $this->dispatch('cart_updated');
        session()->flash('success', 'Cart cleared successfully.');
        $this->dispatch('session-updated-success');
    }



    public function render()
    {

        $cartItems = FacadesCart::instance('cart')->content();

        // dd($cartItems);
        return view('livewire.pages.cart', [
            'cartItems' => $cartItems,
        ]);
    }
}

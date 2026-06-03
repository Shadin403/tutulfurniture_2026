<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        return view('livewire.admin.components.navigation');
    }

    public function logout()
    {
        auth()->logout();
        session()->regenerateToken(); 
        \Surfsidemedia\Shoppingcart\Facades\Cart::instance('cart')->destroy();
        \Surfsidemedia\Shoppingcart\Facades\Cart::instance('wishlist')->destroy();
        session()->flash('logout-success', 'You are logged out');
        $this->redirect(route('login'), navigate: true);
    }
}

<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class SideNavigation extends Component
{

    public function navigateToPage($url)
    {
        // Livewire 3 এ dispatch এর মাধ্যমে ইভেন্ট পাঠানো
        $this->dispatch('navigate', ['url' => $url]);
    }
    public function render()
    {
        return view('livewire.admin.components.side-navigation');
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

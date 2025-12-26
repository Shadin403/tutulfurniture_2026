<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Container\Attributes\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Navigation extends Component
{
    use WithPagination;

    public $cart_count = 0;
    public $wishlist_count = 0;

    // #[Url]
    public $search = '';

    // #[Url]
    public $MoblieSearch = '';

    // public $products = [];
    public $products_count = 0;
    public $MoblieProducts_count = 0;

    protected $listeners = ['cart_updated' => 'updateCartCount', 'wishlist_updated' => 'updateWishlistCount', 'logout' => 'logout'];

    public function mount()
    {
        $this->updateCartCount();
        $this->updateWishlistCount();
    }

    public function updatedSearch($value)
    {
        // $this->search = $value;
        // $this->products = Product::where('name', 'like', '%' . $value . '%')->paginate(4)->items();


        // $this->products_count = count($this->products);
        $this->resetPage();
    }
    public function updatedSearchMobile($value)
    {
        // $this->search = $value;
        // $this->products = Product::where('name', 'like', '%' . $value . '%')->paginate(4)->items();


        // $this->products_count = count($this->products);
        $this->resetPage();
    }
    public function updateCartCount()
    {
        // $this->cart_count = Cart::instance('cart')->content()->count();
        $this->cart_count = Cart::instance('cart')->count();
    }

    public function updateWishlistCount()
    {
        $this->wishlist_count = Cart::instance('wishlist')->count();
    }


    public function removeItem($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        $this->dispatch('cart_updated');
    }




    public function render()
    {


        $categories = Category::with('subCategories')->get();
        $items =  Cart::instance('cart')->content();
        $products = Product::with('reviews')->where('name', 'like', '%' . $this->search . '%')->paginate(10);
        $MoblieProducts = Product::with('reviews')->where('name', 'like', '%' . $this->MoblieSearch . '%')->paginate(10);

        $this->products_count = $products->total(); // count এখানেই set করো
        $this->MoblieProducts_count = $MoblieProducts->total(); // count এখানেই set করো


        return view('livewire.components.navigation', [
            'categories' => $categories,
            'items' => $items,
            'products' => $products,
            'MoblieProducts' => $MoblieProducts
        ]);
    }

    public function logout()
    {
        auth()->logout();
        session()->regenerateToken(); // নতুন CSRF টোকেন তৈরি হচ্ছে
        Cart::instance('cart')->destroy();
        Cart::instance('wishlist')->destroy();
        session()->flash('logout-success', 'You are logged out');
        $this->redirect(route('login'), navigate: true);
    }
}

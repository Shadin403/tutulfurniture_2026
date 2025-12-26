<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Address;
use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

class Dashboard extends Component
{
    use WithPagination;

    #[Url]
    public $activeTab = 'overview';
    public $name;
    public $email;
    public $mobile;
    public $addresses;
    public $current_password;
    public $new_password;
    public $success_message;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->addresses = Address::where('user_id', $user->id)->get();
        // dd($this->address);
    }

    #[Layout('components.layouts.customer')]
    public function render()
    {

        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        // $wishlistItems = $user->wishlist()
        //     ->with('product')
        //     ->latest()
        //     ->take(4)
        //     ->get();

        $recentOrders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.pages.customer.dashboard', [
            'orders' => $orders,
            // 'wishlistItems' => $wishlistItems,
            'recentOrders' => $recentOrders,
            'user' => $user
        ]);
    }
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'mobile' => 'nullable|string|max:20|unique:users,mobile,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);

        $this->success_message = 'Profile updated successfully!';

        $this->dispatch('alert-success', 'Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            $this->dispatch('alert-error', 'The current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->current_password = '';
        $this->new_password = '';
        $this->success_message = 'Password updated successfully!';
        $this->dispatch('alert-success', 'Password updated successfully!');
    }

    public function removeFromWishlist($productId)
    {
        Auth::user()->wishlist()->detach($productId);
    }

    public function addToCart($productId)
    {
        // Add to cart logic here
        $this->emit('cartUpdated');
    }
}

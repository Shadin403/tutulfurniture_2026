<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Overview extends Component
{
    #[Layout('components.layouts.customer')]
    public function render()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->paginate(5);


        $recentOrders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->take(3)
            ->get();
        return view('livewire.pages.customer.overview', [
            'orders' => $orders,
            'recentOrders' => $recentOrders
        ]);
    }
}

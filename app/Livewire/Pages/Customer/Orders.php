<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Orders extends Component
{
    #[Layout('components.layouts.customer')]
    public function render()
    {
        $orders = Order::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.pages.customer.orders', [
            'orders' => $orders
        ]);
    }
}

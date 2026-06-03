<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $order_id, $name, $phone, $division, $district, $upazila, $locality, $address, $postal_code;
    public $subtotal = 0, $discount = 0, $tex = 0, $total = 0;
    public $status = 'ordered', $type = 'home', $user_id;

    public function mount($id)
    {
        $order = Order::findOrFail($id);
        $this->order_id = $order->id;
        $this->name = $order->name;
        $this->phone = $order->phone;
        $this->division = $order->division;
        $this->district = $order->district;
        $this->upazila = $order->upazila;
        $this->locality = $order->locality;
        $this->address = $order->address;
        $this->postal_code = $order->postal_code;
        $this->subtotal = $order->subtotal;
        $this->discount = $order->discount;
        $this->tex = $order->tex;
        $this->total = $order->total;
        $this->status = $order->status;
        $this->type = $order->type;
        $this->user_id = $order->user_id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'address' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::find($this->order_id);
        $order->name = $this->name;
        $order->phone = $this->phone;
        $order->division = $this->division ?? '';
        $order->district = $this->district ?? '';
        $order->upazila = $this->upazila ?? '';
        $order->locality = $this->locality ?? '';
        $order->address = $this->address;
        $order->postal_code = $this->postal_code ?? '';
        $order->subtotal = $this->subtotal;
        $order->discount = $this->discount;
        $order->tex = $this->tex;
        $order->total = $this->total;
        $order->status = $this->status;
        $order->type = $this->type;
        $order->user_id = $this->user_id;
        $order->save();

        session()->flash('success', 'Order updated successfully!');
        return redirect()->route('admin.orders');
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.admin.order.edit', compact('users'))->layout('components.layouts.admin');
    }
}

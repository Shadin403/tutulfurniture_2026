<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Addresses extends Component
{

    public $addresses;

    public function mount()
    {
        $user = Auth::user();
        $this->addresses = Address::where('user_id', $user->id)->get();
    }


    #[Layout('components.layouts.customer')]
    public function render()
    {
        return view('livewire.pages.customer.addresses');
    }
}

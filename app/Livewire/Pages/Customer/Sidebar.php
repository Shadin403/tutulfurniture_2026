<?php

namespace App\Livewire\Pages\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Sidebar extends Component
{
    #[Layout('components.layouts.customer')]
    public function render()
    {
        return view('livewire.pages.customer.sidebar');
    }
}

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
}

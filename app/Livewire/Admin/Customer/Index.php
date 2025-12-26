<?php

namespace App\Livewire\Admin\Customer;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'Newest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function getSearchCustomers()
    {
        $query = User::where('role', 'customer')
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $this->search . '%');
            });

        // Sort condition
        switch ($this->sortBy) {
            case 'Name(A-Z)':
                $query->orderBy('name', 'asc');
                break;
            case 'Name(Z-A)':
                $query->orderBy('name', 'desc');
                break;
            case 'Oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate(10);
    }


    public function selectSort($value)
    {
        $this->sortBy = $value;
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $customers_count = User::where('role', 'customer')->count();
        $customers = $this->getSearchCustomers();

        return view('livewire.admin.customer.index', [
            'customers' => $customers,
            'customers_count' => $customers_count
        ]);
    }
}

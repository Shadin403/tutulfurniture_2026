<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;



class Index extends Component
{


    use WithPagination;

    #[On('deleteBrand')]
    public function deleteBrand($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            session()->flash('error', 'Brand not found!');
            return;
        }

        // Check if image exists and delete it from storage
        if ($brand->image && Storage::disk('public')->exists("uploads/brands/{$brand->image}")) {
            Storage::disk('public')->delete("uploads/brands/{$brand->image}");
        }


        // Delete brand from database
        $brand->delete();

        // Emit event to refresh frontend
        $this->dispatch('brandDeleted');

        session()->flash('success', 'Brand deleted successfully!');
    }

    public function render()
    {
        // $brands = Cache::remember('brand_data', 180, function () {
        //     return Brand::orderBy('id', 'desc')->paginate(5);
        // });

        $brands = Brand::orderBy('id', 'desc')->paginate(5);
        return view(
            'livewire.admin.brand.index',
            [
                'brands' => $brands
            ]
        )
            ->layout('components.layouts.admin');
    }
}

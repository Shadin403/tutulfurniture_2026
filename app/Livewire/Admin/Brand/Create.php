<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;


    public $name, $slug, $image, $description = '';

    public function storeBrand()
    {
        // Validation আলাদা রাখা হলো
        $this->validate([
            'name' => 'required|string|unique:brands',
            'slug' => 'required|string|unique:brands',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ]);

        try {
            $imageName = null;

            if ($this->image) {
                $image = $this->image;
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/brands', $imageName, 'public');
            }


            // Create New Brand
            $brand = new Brand();
            $brand->name = $this->name;
            $brand->slug = $this->slug;
            $brand->description = $this->description;
            $brand->image = $imageName;
            $brand->save();

            session()->flash('success', 'Brand created successfully!');
            $this->reset(['name', 'slug', 'image', 'description']);
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.brand.create');
    }
}

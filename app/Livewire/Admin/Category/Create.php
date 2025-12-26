<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;


    public $name, $slug, $image, $description = "";

    public function storeCategory()
    {
        // Validation Alada Rakha hoilo
        $this->validate([
            'name' => 'required|string|unique:categories',
            'slug' => 'required|string|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ]);

        try {
            $imageName = null;
            if ($this->image) {
                $image = $this->image;
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/categories', $imageName, 'public');
            }


            // Create New Brand
            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->description = $this->description;
            $category->image = $imageName;
            $category->save();

            session()->flash('success', 'Category created successfully!');
            $this->reset('name', 'slug', 'image', 'description');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }




    public function render()
    {
        return view('livewire.admin.category.create')->layout('components.layouts.admin');;
    }
}

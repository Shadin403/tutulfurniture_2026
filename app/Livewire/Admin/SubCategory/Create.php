<?php

namespace App\Livewire\Admin\SubCategory;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $category_id, $name, $slug, $image, $description;

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function createSubCategory()
    {
        // Validation Alada Rakha hoilo
        $this->validate([
            'name' => 'required|string|unique:categories',
            'slug' => 'required|string|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'category_id' => 'required'
        ]);

        try {
            $imageName = null;
            if ($this->image) {
                $image = $this->image;
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/sub-categories', $imageName, 'public');
            }


            // Create New Brand
            $category = new SubCategory();
            $category->category_id = $this->category_id;
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->description = $this->description;
            $category->image = $imageName;
            $category->save();

            session()->flash('success', 'Sub Category created successfully!');
            $this->reset('name', 'slug', 'image', 'description');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong! ' . $e->getMessage());
        }
    }




    public function render()
    {

        $categories = Category::all();

        return view('livewire.admin.sub-category.create', [
            'categories' => $categories
        ])->layout('components.layouts.admin');
    }
}

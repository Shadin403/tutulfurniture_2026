<?php

namespace App\Livewire\Admin\Category;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $categoryId, $name, $slug, $image, $description = "", $oldImage;

    public function mount($id)
    {
        $this->categoryId = $id;
        $category = Category::find($this->categoryId);
        if (!$category) {
            session()->flash('error', 'Category not found!');
            return;
        }

        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->oldImage = $category->image;
    }



    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                : '',
        ]);

        $category = Category::findOrFail($this->categoryId);


        if ($this->image instanceof TemporaryUploadedFile) {

            if ($this->oldImage && Storage::disk('public')->exists("uploads/categories/{$this->oldImage}")) {
                Storage::disk('public')->delete("uploads/categories/{$this->oldImage}");
            }


            $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('uploads/categories', $imageName, 'public');


            $category->image = $imageName;
        } else {
            $category->image = $this->oldImage;
        }
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->save();

        session()->flash('success', 'Category updated successfully!');
        $this->redirect(route('admin.all.categories'), navigate: true);
    }






    public function render()
    {
        return view('livewire.admin.category.edit')->layout('components.layouts.admin');;
    }
}

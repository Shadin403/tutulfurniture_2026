<?php

namespace App\Livewire\Admin\SubCategory;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class Edit extends Component
{
    use WithFileUploads;
    public $subcategory_Id, $category_id, $name, $slug, $image, $description, $oldImage;

    public $categories;
    public function mount($id)
    {
        $this->subcategory_Id = $id;
        $sub_category = SubCategory::find($this->subcategory_Id);

        if (!$sub_category) {
            session()->flash('error', 'Sub Category not found!');
            return;
        }

        $this->category_id = $sub_category->category_id;
        $this->name = $sub_category->name;
        $this->slug = $sub_category->slug;
        $this->image = $sub_category->image;
        $this->description = $sub_category->description;
        $this->oldImage = $sub_category->image;

        $this->categories = Category::select('id', 'name')->get();
    }

    public function updateSubCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                : '',

            'category_id' => 'required'
        ]);

        $sub_category = SubCategory::findOrFail($this->subcategory_Id);


        if ($this->image instanceof TemporaryUploadedFile) {

            if ($this->oldImage && Storage::disk('public')->exists("uploads/sub-categories/{$this->oldImage}")) {
                Storage::disk('public')->delete("uploads/sub-categories/{$this->oldImage}");
            }


            $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('uploads/sub-categories', $imageName, 'public');


            $sub_category->image = $imageName;
        } else {
            $sub_category->image = $this->oldImage;
        }
        $sub_category->category_id = $this->category_id;
        $sub_category->name = $this->name;
        $sub_category->slug = $this->slug;
        $sub_category->description = $this->description;

        $sub_category->save();

        session()->flash('success', 'Sub Category updated successfully!');
        $this->redirect(route('admin.all.subCategories'), navigate: true);
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {

        return view('livewire.admin.sub-category.edit');
    }
}

<?php

namespace App\Livewire\Admin\Brand;

use Carbon\Carbon;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class Edit extends Component
{
    use WithFileUploads;


    public $brandId, $name, $slug, $image, $description = '', $oldImage;



    public function mount($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            session()->flash('error', 'Brand not found!');
            $this->redirect(route('admin.all.brands'), navigate: true);
        }

        $this->brandId = $brand->id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->description = $brand->description;
        $this->oldImage = $brand->image;
    }
    public function updateBrand()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                : '',
        ]);

        $brand = Brand::findOrFail($this->brandId);


        if ($this->image instanceof TemporaryUploadedFile) {

            if ($this->oldImage && Storage::disk('public')->exists("uploads/brands/{$this->oldImage}")) {
                Storage::disk('public')->delete("uploads/brands/{$this->oldImage}");
            }


            $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('uploads/brands', $imageName, 'public');


            $brand->image = $imageName;
        } else {
            $brand->image = $this->oldImage;
        }
        $brand->name = $this->name;
        $brand->slug = $this->slug;
        $brand->description = $this->description;
        $brand->save();

        session()->flash('success', 'Brand updated successfully!');
        $this->redirect(route('admin.all.brands'), navigate: true);
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        return view('livewire.admin.brand.edit')->layout('components.layouts.admin');
    }
}

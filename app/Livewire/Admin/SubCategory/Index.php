<?php

namespace App\Livewire\Admin\SubCategory;

use Livewire\Component;
use App\Models\SubCategory;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {

        $sub_categories = SubCategory::orderBy('id', 'desc')->paginate(10);
        $sub_categories_count = SubCategory::count();
        return view('livewire.admin.sub-category.index', [
            'sub_categories' => $sub_categories,
            'sub_categories_count' => $sub_categories_count
        ])->layout('components.layouts.admin');
    }



    #[On('deleteSubCategory')]
    public function SubCategoryDeleted($id)
    {


        $sub_category = SubCategory::find($id);

        if (!$sub_category) {
            session()->flash('error', 'Brand not found!');
            return;
        }

        // Check if image exists and delete it from storage
        if ($sub_category->image && Storage::disk('public')->exists("uploads/categories/{$sub_category->image}")) {
            Storage::disk('public')->delete("uploads/sub-categories/{$sub_category->image}");
        }


        // Delete brand from database
        $sub_category->delete();

        // Dispatch event to refresh frontend
        $this->dispatch('SubCategoryDeleted');

        session()->flash('success', 'Sub Category deleted successfully!');
    }
}

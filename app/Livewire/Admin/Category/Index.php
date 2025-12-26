<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;



    public function render()
    {
        // $categories = Cache::remember('category_data', 180, function () {
        //     return Category::orderBy('id', 'desc')->paginate(5);
        // });

        $categoryCount = Category::count();
        $categories = Category::orderBy('id', 'desc')->paginate(15);
        return view('livewire.admin.category.index', [
            'categories' => $categories,
            'categoryCount' => $categoryCount
        ])->layout('components.layouts.admin');
    }


    #[On('deleteCategory')]
    public function deleteCategory($id)
    {


        $category = Category::find($id);

        if (!$category) {
            session()->flash('error', 'Brand not found!');
            return;
        }

        // Check if image exists and delete it from storage
        if ($category->image && Storage::disk('public')->exists("uploads/categories/{$category->image}")) {
            Storage::disk('public')->delete("uploads/categories/{$category->image}");
        }


        // Delete brand from database
        $category->delete();

        // Dispatch event to refresh frontend
        $this->dispatch('brandDeleted');

        session()->flash('success', 'Brand deleted successfully!');
    }
}

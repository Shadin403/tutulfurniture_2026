<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;


    public $search = '';
    #[Url]
    public $perPage = 10;
    public $sortBy = 'Sort by';
    public $filter = '';




    //!  Search Function
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //!  Sort Function
    public function selectSort()
    {
        // $this->sortBy = $value;
        $this->resetPage();
    }

    //!  Sort Function
    public function sortUpdated($value)
    {
        $this->sortBy = $value;
    }

    //!  Filter Function
    public function filterUpdated($value)
    {
        $this->filter = $value;
    }

    //! perPage Function
    public function perPageValueChange($value)
    {
        $this->perPage = $value;
    }

    public function getProducts()
    {
        $query = Product::query()
            ->leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
            ->select('products.*', 'product_details.regular_price')
            ->with('productDetail'); // চাইলে relation load করো


        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('SKU', 'like', '%' . $this->search . '%');
        });

        //! Sort condition
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
            case 'Instock Product':
                $query->where('stock_status', 'instock');
                break;

            case 'Outofstock Product':
                $query->where('stock_status', 'outofstock');
                break;
            case 'Price_Low_to_High':
                $query->orderBy('product_details.regular_price', 'asc');
                break;
            case 'Price_High_to_Low':
                $query->orderBy('product_details.regular_price', 'asc');
                break;
            case 'Active Product':
                $query->where('is_active', '1');
                break;
            case 'Inactive Product':
                $query->where('is_active', '0');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        //! Filter condition
        switch ($this->filter) {
            case '0-100':
                $query->whereBetween('product_details.regular_price', [0, 100]);
                break;
            case '101-500':
                $query->whereBetween('product_details.regular_price', [101, 500]);
                break;
            case '501-1000':
                $query->whereBetween('product_details.regular_price', [501, 1000]);
                break;
            case '1001-2000':
                $query->whereBetween('product_details.regular_price', [1001, 2000]);
                break;
            case '2001-3000':
                $query->whereBetween('product_details.regular_price', [2001, 3000]);
                break;
            case '3001-4000':
                $query->whereBetween('product_details.regular_price', [3001, 4000]);
                break;
            case '4001-5000':
                $query->whereBetween('product_details.regular_price', [4001, 5000]);
                break;
            case '5001-20000':
                $query->whereBetween('product_details.regular_price', [5001, 20000]);
                break;
            case '20001-50000':
                $query->whereBetween('product_details.regular_price', [20001, 50000]);
                break;
            case '50001-100000':
                $query->whereBetween('product_details.regular_price', [50001, 100000]);
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate($this->perPage);
    }



    //!  product delete Function
    #[On('deleteProduct')]
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            session()->flash('error', 'Product not found');
            return;
        }
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->gallery_images) {
            $galleryImages = $product->gallery_images;
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $image) {
                    if (Storage::disk('public')->exists('uploads/products/gallery/' . $image)) {
                        Storage::disk('public')->delete('uploads/products/gallery/' . $image);
                    }
                }
            }
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        $products_count = Product::count();
        $products = $this->getProducts();
        return view('livewire.admin.product.index', [
            'products' => $products,
            'products_count' => $products_count
        ]);
    }
}

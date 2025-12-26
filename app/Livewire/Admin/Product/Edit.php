<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Product;
use Exception;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductDetail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{

    use WithFileUploads;


    // Products table fields
    public $product_id;
    public $name;
    public $slug;
    public $SKU;
    public $stock_status;
    public $quantity;
    public $image;
    public $gallery_images = [];
    public $category_id;
    public $brand_id;
    public $sub_category_id;
    public $featured = 0;
    public $tags = [];
    public $is_active = 1;
    public $oldImage;
    public $oldGalleryImages;

    // Product_details table fields
    public $material;
    public $dimensions = [
        'length' => '',
        'width' => '',
        'height' => ''
    ];
    public $weight;
    public $size;
    public $color;
    public $short_description = "";
    public $description = "";
    public $regular_price;
    public $discount_price;
    public $discount_time;
    public $extra_info;
    public $warranty;
    public $assembly_required = 0;
    public $indoor_outdoor;
    public $meta_title;
    public $meta_description;

    // For dropdowns
    public $brands = [];
    public $categories = [];
    public $subCategories = [];






    public function mount($id = null)
    {

        $this->product_id = $id;
        $product = Product::find($this->product_id);

        $product_details = $product->productDetail;

        // dd($product_details);
        if (!$product) {
            session()->flash('error', 'Product not found!');
            $this->redirect(route('admin.all.products'), navigate: true);
        }

        // Product
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->quantity = $product->quantity;
        $this->oldImage = $product->image;
        $this->oldGalleryImages = $product->gallery_images;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->sub_category_id = $product->sub_category_id;
        $this->featured = $product->featured;
        $this->tags = $product->tags;
        $this->is_active = $product->is_active;
        $this->material = $product_details->material ?? null;


        // $this->dimensions = [
        //     'length' => $product_details->length ?? null,
        //     'width' => $product_details->width ?? null,
        //     'height' => $product_details->height ?? null
        // ];


        if (!empty($product_details->dimensions)) {
            foreach ($product_details->dimensions as $key => $value) {
                $this->dimensions[$key] = $value;
            }
        }


        $this->weight = $product_details->weight ?? null;
        $this->size = $product_details->size ?? null;
        $this->color = $product_details->color ?? null;
        $this->short_description = $product_details->short_description ?? null;
        $this->description = $product_details->description ?? null;
        $this->regular_price = $product_details->regular_price ?? null;
        $this->discount_price = $product_details->discount_price ?? null;
        $this->discount_time = $product_details->discount_time ?? null;
        $this->extra_info = $product_details->extra_info ?? null;
        $this->warranty = $product_details->warranty ?? null;
        $this->assembly_required = $product_details->assembly_required ?? null;
        $this->indoor_outdoor = $product_details->indoor_outdoor ?? null;
        $this->meta_title = $product_details->meta_title ?? null;
        $this->meta_description = $product_details->meta_description ?? null;



        $this->brands = Brand::select('id', 'name')->orderBy('name', 'desc')->get();
        $this->categories = Category::select('id', 'name')->orderBy('name', 'desc')->get();
        $this->subCategories = SubCategory::where('category_id', $this->category_id)->get();
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
        $this->sub_category_id = null;
    }




    public function updateProduct()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required|string|unique:products,slug,' . $this->product_id,
            'SKU' => 'required|string|unique:products,SKU,' . $this->product_id,
            'stock_status' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'regular_price' => 'required|numeric|min:0',
            'discount_price' => 'sometimes|nullable|numeric|min:0|lt:regular_price',
            'discount_time' => 'nullable|date_format:H:i|before:tomorrow',
            'image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'material' => 'nullable|string',
            'dimensions.*' => 'nullable|string',
            'weight' => 'nullable|string',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'extra_info' => 'nullable|string',
            'warranty' => 'nullable|string',
            'assembly_required' => 'required|boolean',
            'indoor_outdoor' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::find($this->product_id);

            // Image Upload
            if ($this->image && is_object($this->image)) {
                if ($this->oldImage) {
                    Storage::disk('public')->delete('uploads/products/' . $this->oldImage);
                }

                $imageName = time() . '.' . $this->image->extension();
                $this->image->storeAs('uploads/products', $imageName, 'public');
                $product->image = $imageName;
            }

            // Gallery Images Upload
            if (is_array($this->gallery_images) && count($this->gallery_images) > 0) {
                $existingGalleryImages = is_string($this->oldGalleryImages) ? json_decode($this->oldGalleryImages, true) : [];
                $galleryNames = is_array($existingGalleryImages) ? $existingGalleryImages : [];

                foreach ($this->gallery_images as $image) {
                    if (is_object($image)) {
                        $imageName = time() . rand(1, 99) . '.' . $image->extension();
                        $image->storeAs('uploads/products/gallery', $imageName, 'public');
                        $galleryNames[] = $imageName;
                    }
                }

                $product->gallery_images = $galleryNames;
            }

            // Basic Product Info
            $product->name = $this->name;
            $product->slug = $this->slug;
            $product->SKU = $this->SKU;
            $product->stock_status = $this->stock_status;
            $product->quantity = $this->quantity;
            $product->category_id = $this->category_id;
            $product->brand_id = $this->brand_id;
            $product->sub_category_id = $this->sub_category_id;
            $product->featured = $this->featured;
            $product->tags = is_array($this->tags) ? json_encode($this->tags) : $this->tags;
            $product->is_active = $this->is_active;


            $product->save();

            Log::info('Product updated successfully.', ['product_id' => $product->id]);

            // Update product details
            $productDetail = ProductDetail::where('product_id', $product->id)->first();
            if (!$productDetail) {
                $productDetail = new ProductDetail();
                $productDetail->product_id = $product->id;
            }

            $productDetail->material = $this->material;
            $productDetail->dimensions = $this->dimensions;
            $productDetail->weight = $this->weight;
            $productDetail->size = $this->size;
            $productDetail->color = $this->color;
            $productDetail->short_description = $this->short_description;
            $productDetail->description = $this->description;
            $productDetail->regular_price = $this->regular_price;
            $productDetail->discount_price = $this->discount_price !== '' ? $this->discount_price : null;
            $productDetail->discount_time = $this->discount_time;
            $productDetail->extra_info = $this->extra_info;
            $productDetail->warranty = $this->warranty;
            $productDetail->assembly_required = $this->assembly_required;
            $productDetail->indoor_outdoor = $this->indoor_outdoor;
            $productDetail->meta_title = $this->meta_title;
            $productDetail->meta_description = $this->meta_description;

            $productDetail->save();

            DB::commit();

            Log::info('Product details updated successfully.', ['product_id' => $product->id]);

            session()->flash('success', 'Product updated successfully!');
            $this->redirect(route('admin.all.products'), navigate: true);
        } catch (QueryException $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update product: ' . $e->getMessage());
        }
    }








    public function removeGalleryImage($index)
    {
        try {
            if ($this->oldGalleryImages) {
                $galleryImages = is_string($this->oldGalleryImages) ? json_decode($this->oldGalleryImages, true) : $this->oldGalleryImages;

                if (isset($galleryImages[$index])) {

                    Storage::disk('public')->delete('uploads/products/gallery/' . $galleryImages[$index]);


                    unset($galleryImages[$index]);
                    $this->oldGalleryImages = array_values($galleryImages);
                    $product = Product::find($this->product_id);
                    $product->gallery_images = $this->oldGalleryImages;
                    $product->save();
                    log::info($product);
                    session()->flash('success', 'Gallery image removed successfully!');
                }
            }
        } catch (Exception $e) {
            session()->flash('error', 'Failed to remove gallery image: ' . $e->getMessage());
        }
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.product.edit');
    }
}

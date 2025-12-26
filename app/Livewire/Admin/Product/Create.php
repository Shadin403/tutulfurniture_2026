<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProductDetail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class Create extends Component
{

    use WithFileUploads;


    // Products table fields
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


    protected $rules = [
        // Basic Information
        'name' => 'required|string|min:3',
        'slug' => 'required|string|unique:products,slug',
        'SKU' => 'required|string|unique:products,SKU',

        // Stock & Quantity
        'stock_status' => 'required|string',
        'quantity' => 'required|integer|min:0',

        // Pricing
        'regular_price' => 'required|numeric|min:0',
        'discount_price' => 'sometimes|nullable|numeric|min:0|lt:regular_price',
        'discount_time' => 'nullable|date_format:H:i',

        // Image Upload
        'image' => 'required|image|max:2048',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // Category & Brand
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'required|exists:sub_categories,id',
        'brand_id' => 'required|exists:brands,id',

        // Product Attributes
        'material' => 'nullable|string',
        'dimensions.*' => 'nullable|string',
        'weight' => 'nullable|string',
        'size' => 'nullable|string',
        'color' => 'nullable|string',

        // Descriptions
        'short_description' => 'nullable|string',
        'description' => 'nullable|string',
        'extra_info' => 'nullable|string',

        // Additional Info
        'warranty' => 'nullable|string',
        'assembly_required' => 'required|boolean',
        'indoor_outdoor' => 'nullable|string',

        // SEO Meta Data
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
    ];


    public function mount()
    {


        $this->brands = Brand::all();
        $this->categories = Category::all();
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



    public function save()
    {

        $this->validate();
        // dd($this->dimensions);

        DB::beginTransaction();

        try {

            // ✅ Step 1: Product Create
            $product = new Product();
            $product->name = $this->name;
            $product->slug = $this->slug;
            $product->SKU = $this->SKU;
            $product->stock_status = $this->stock_status;
            $product->quantity = $this->quantity;
            $product->category_id = $this->category_id;
            $product->brand_id = $this->brand_id;
            $product->sub_category_id = $this->sub_category_id;
            $product->featured = $this->featured;
            $product->tags = $this->tags;
            $product->is_active = $this->is_active;


            if ($this->image) {
                $imageName = time() . '.' . $this->image->extension();
                $this->image->storeAs('uploads/products', $imageName, 'public');
                $product->image = $imageName;
            }

            if (count($this->gallery_images) > 0) {
                $galleryNames = [];
                foreach ($this->gallery_images as $image) {
                    $imageName = time() . rand(1, 99) . '.' . $image->extension();
                    $image->storeAs('uploads/products/gallery', $imageName, 'public');
                    $galleryNames[] = $imageName;
                }
                $product->gallery_images = $galleryNames;
            }

            $product->save();

            //  Step 2: Ensure product ID exists before saving product details
            if (!$product->id) {
                throw new \Exception("Product ID missing after save");
            }

            //  Step 3: Debugging Check
            FacadesLog::info("Product created successfully: ID => " . $product->id);

            //  Step 4: Product Detail Create
            $productDetail = new ProductDetail();
            $productDetail->product_id = $product->id;
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

            //  Step 5: Debugging Check
            FacadesLog::info("ProductDetail created successfully for Product ID => " . $product->id);
            DB::commit();
            session()->flash('success', 'Product created successfully!');
            $this->reset();
            // $this->redirect(route('admin.all.products'), navigate: true);
            $this->redirect(route('admin.all.products'), navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            FacadesLog::error("Failed to create product: " . $e->getMessage());
            session()->flash('error', 'Failed to create product: ' . $e->getMessage());
        }
    }



    #[Layout('components.layouts.admin')]
    public function render()
    {

        return view('livewire.admin.product.create');
    }
}

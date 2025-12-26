<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Shop extends Component
{
    use WithPagination;


    //product cart modal variables

    public $cartProductId;
    public $cartProductName;
    public $cartProductSlug;
    public $cartProductImage;
    public $cartProductRegularPrice;
    public $cartProductDiscountPrice;
    public $cartProductSize;
    public $cartProductMaterial;
    public $cartProductQuantity;

    //category variables
    public $categories;
    public $visibleCountC = 5;
    public $openC = true;

    //subCategory variable;
    public $sub_categories;
    public $visibleCountSC = 5;
    public $openSC = true;


    //filter variables
    #[Url]
    public $shortBy = 'Latest';
    #[Url]
    public $parPageValue = 12;

    //Category by Product Filter
    #[Url(as: 'category')]
    public $selectedCategories = [];
    #[Url(as: 'subcategory')]
    public $selectedSubCategories = [];

    public function mount()
    {

        $this->categories = Category::select('id', 'name', 'slug', 'image')->get();
        $this->sub_categories = SubCategory::select('id', 'name', 'slug', 'image')->get();

        $this->selectedCategories = (array) $this->selectedCategories;
        $this->selectedSubCategories = (array) $this->selectedSubCategories;
    }

    //! Loading More Function For Category
    public function loadMore()
    {
        $this->visibleCountC += 10;
    }

    //! see Less Funtion For Category
    public function seeLess()
    {
        $this->visibleCountC = 5;
        // dd($this->visibleCountC);
    }
    //! see Less Funtion For Category
    public function seeLessSC()
    {
        $this->visibleCountSC = 5;
        // dd($this->visibleCountC);
    }

    //! Loading More Function For SubCategory
    public function loadMoreSC()
    {
        $this->visibleCountSC += 10;
        // dd($this->visibleCountC);
    }

    // ! filter functions
    public function shortByValueChange($value)
    {
        $this->shortBy = $value;
        logger('ShortBy Updated: ' . $value);
    }

    // ! filter functions
    public function perPageValueChange($value)
    {
        $this->parPageValue = $value;
        logger('ShortBy Updated: ' . $value);
    }

    // ! filter functions
    public function getSortedProductsQuery()
    {
        $query = Product::query()
            ->leftJoin('product_details', 'products.id', '=', 'product_details.product_id')
            ->select('products.*', 'product_details.regular_price')
            ->with('productDetail'); // চাইলে relation load করো


        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        if (!empty($this->selectedSubCategories)) {
            $query->whereIn('sub_category_id', $this->selectedSubCategories);
        }



        switch ($this->shortBy) {
            case 'price_low_to_high':
                $query->orderBy('product_details.regular_price', 'asc');
                break;
            case 'price_high_to_low':
                $query->orderBy('product_details.regular_price', 'desc');
                break;
            case 'latest':
                $query->latest('products.created_at');
                break;
            case 'oldest':
                $query->oldest('products.created_at');
                break;
            case 'Featured':
                $query->where('products.is_featured', 1);
                break;
            default:
                $query->latest('products.created_at');
        }

        return $query;
    }




    //! fiter by category in prduct card

    public function filterByCategory($productId)
    {
        $this->selectedCategories = [$productId];
    }

    //! fiter by subcategory in prduct card

    public function filterBySubCategory($productId)
    {
        $this->selectedSubCategories = [$productId];
    }




    public function render()
    {

        usleep(500000);

        // dump(Cart::instance('cart')->content());

        $productsQuery = $this->getSortedProductsQuery();
        $products = $productsQuery->paginate($this->parPageValue);

        $products_count = Product::count();
        $visibleCategories =  $this->categories->take($this->visibleCountC);
        $visibleSubCategories = $this->sub_categories->take($this->visibleCountSC);

        return view('livewire.pages.shop', [
            'products' => $products,
            'products_count' => $products_count,
            'visibleCategories' => $visibleCategories,
            'visibleSubCategories' => $visibleSubCategories

        ]);
    }


    //! add to cart function
    public function addToCart($product_id)
    {
        $product = Product::find($product_id);
        $product_details = $product->productDetail;



        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }

        // dd($product);
        if ($product) {
            Cart::instance('cart')
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('success', 'Product added to cart successfully.');

        $this->dispatch('cart_updated');
    }

    //! add to cart Modal function
    public function CartProductModal($productId)
    {
        $product = Product::find($productId);
        $this->cartProductName = $product->name;
        $this->cartProductSlug = $product->slug;
        $this->cartProductImage = $product->image;
        $this->cartProductRegularPrice = $product->productDetail->regular_price;
        $this->cartProductDiscountPrice = $product->productDetail->discount_price;
        $this->cartProductSize = $product->productDetail->size;
        $this->cartProductMaterial = $product->productDetail->material;
        $this->cartProductQuantity = $product->quantity;
    }


    //! add to wishlist function
    public function addToWishlist($product_id)
    {
        $product = Product::find($product_id);
        $product_details = $product->productDetail;



        if ($product_details->discount_price) {
            $price = $product_details->discount_price;
        } else {
            $price = $product_details->regular_price;
        }

        if ($product) {
            Cart::instance('wishlist')
                ->add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [
                    'image' => $product->image,
                    'slug' => $product->slug,
                ]])
                ->associate('App\Models\Product');
        }

        $this->dispatch('wishlist_updated');

        $this->dispatch('alert-success', 'Product added to wishlist successfully.');
    }

    //! remove to wishlist function
    public function removeFromWishlist($product_id)
    {

        Cart::instance('wishlist')->remove($product_id);
        $this->dispatch('wishlist_updated');
        $this->dispatch('alert-warning', 'Product removed from wishlist successfully.');
    }

    // //! setCategory_id Function
    // public function selectSubCategory($category_id)
    // {
    //     $this->sub_category_id = $category_id;
    // }

    // //! category_id Function
    // public function selectCategory($category_id)
    // {
    //     $this->category_id = $category_id;
    // }
}

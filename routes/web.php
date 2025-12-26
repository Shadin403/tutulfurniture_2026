<?php

use App\Models\Category;
use App\Models\SubCategory;




use App\Livewire\Auth\Login;



use App\Livewire\Pages\Cart;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Shop;




use App\Livewire\Auth\Register;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Checkout;

//Customer Dashboard
use App\Livewire\Pages\Customer\Dashboard as CustomerDashboard;

//category
use App\Livewire\Pages\Wishlist;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
//sub-category
use App\Http\Middleware\AdminMiddlewere;
use App\Livewire\Admin\Product\Productdetail;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\WishlistController;
//brand
use App\Livewire\Admin\Brand\Index as AllBrands;
use App\Livewire\Admin\Brand\Create as BrandCreate;
use App\Livewire\Admin\Brand\Edit as BrandEdit;

//category
use App\Livewire\Admin\Category\Index as AllCategories;
use App\Livewire\Admin\Category\Create as CategoryCreate;
use App\Livewire\Admin\Category\Edit as CategoryEdit;

//sub-category
use App\Livewire\Admin\SubCategory\Index as AllSubCategories;
use App\Livewire\Admin\SubCategory\Create as SubCategoryCreate;
use App\Livewire\Admin\SubCategory\Edit as SubCategoryEdit;

//product
use App\Livewire\Admin\Product\Index as AllProducts;
use App\Livewire\Admin\Product\Create as ProductCreate;
use App\Livewire\Admin\Product\Edit as ProductEdit;

//slider
use App\Livewire\Admin\Slider\Index as Sliders;
use App\Livewire\Admin\Slider\Create as SliderCreate;
use App\Livewire\Admin\Slider\Edit as SliderEdit;


// admin customer
use App\Livewire\Admin\Customer\Index as AllCustomers;
use App\Livewire\Admin\Order\Create;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Resetpassword;
use App\Livewire\Pages\Customer\Addresses;
use App\Livewire\Pages\Customer\Orders;
use App\Livewire\Pages\Customer\Overview;
use App\Livewire\Pages\Customer\Profile;
// web product details
use App\Livewire\Pages\Productdetails as WebProductdetails;

Route::get('/', Home::class)->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/product-details/{slug}', WebProductdetails::class)->name('product.details');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/wishlist', Wishlist::class)->name('wishlist');

Route::post('wishlist/add/{id}', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
// Change it to:
Route::post('wishlist/remove-by-id/{id}', [WishlistController::class, 'remove_by_product_id'])->name('wishlist.remove_by_id');

Route::post('/add-to-cart/{id}', [WishlistController::class, 'add_to_cart'])->name('add_to_cart');

Route::middleware(['guest'])->group(function () {
    //auth routes
    Route::get('/login', Login::class)->name('login');
    // Route::get('/register', Register::class)->name('register');

    //------------- forgot password-------------//
    Route::get('/forgot-password', ForgotPassword::class)->name('password.email');
    Route::get('/reset-password/{token}', Resetpassword::class)->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
    Route::get('customer/dashboard', CustomerDashboard::class)->name('customer.dashboard');
    // Route::get('/premium-dashboard', \App\Livewire\Pages\Customer\PremiumDashboard::class)->name('customer.premium.dashboard');
    Route::get('/checkout', Checkout::class)->name('checkout');

    Route::get('customer/dashboard/overview', Overview::class)->name('customer.dashboard.overview');
    Route::get('customer/dashboard/orders', Orders::class)->name('customer.dashboard.orders');
    Route::get('customer/dashboard/profile', Profile::class)->name('customer.dashboard.profile');
    Route::get('customer/dashboard/addresses', Addresses::class)->name('customer.dashboard.addresses');
});

Route::middleware(['auth', AdminMiddlewere::class])->prefix('admin')->group(function () {

    //maintenance routes
    Route::get('brand-cache', [MaintenanceController::class, 'brandCache'])->name('brand.cache');
    //end maintenance routes


    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

    //Customer Routes
    Route::get('/all-customers', AllCustomers::class)->name('admin.all.customers');

    //Product Route
    Route::get('/all-products', AllProducts::class)->name('admin.all.products');
    Route::get('/create-product', ProductCreate::class)->name('admin.product.create');
    Route::get('/edit-product/{id}', ProductEdit::class)->name('admin.product.edit');
    Route::get('/product-details/{id}', Productdetail::class)->name('admin.product.detail');


    //Brand Routes
    Route::get('/all-brands', AllBrands::class)->name('admin.all.brands');
    Route::get('/create-brand', BrandCreate::class)->name('admin.brand.create');
    Route::get('/edit-brand/{id}', BrandEdit::class)->name('admin.brand.edit');

    //category routes
    Route::get('/all-categories', AllCategories::class)->name('admin.all.categories');
    Route::get('/create-category', CategoryCreate::class)->name('admin.category.create');
    Route::get('/edit-category/{id}', CategoryEdit::class)->name('admin.category.edit');


    //sub-category Routes
    Route::get('/all-sub-categories', AllSubCategories::class)->name('admin.all.subCategories');
    Route::get('/create-sub-categories', SubCategoryCreate::class)->name('admin.subCategory.create');
    Route::get('/edit-sub-categories/{id}', SubCategoryEdit::class)->name('admin.subCategory.edit');

    //slider routes
    Route::get('/sliders', Sliders::class)->name('admin.all.sliders');
    Route::get('/create-slider', SliderCreate::class)->name('admin.slider.create');
    Route::get('/edit-slider/{id}', SliderEdit::class)->name('admin.slider.edit');
});

<div>


    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1  d-lg-block">
            <div class="container" style="width: 120%;">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info d-none d-lg-block">
                            <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#">
                                        <i class="fi-rs-world"></i> English
                                        <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li>
                                            <a href="#"><img
                                                    src="assets/imgs/theme/330px-Flag_of_Bangladesh.svg.png"
                                                    alt="" />bangla</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div class="d-inline-block">
                                <ul>
                                    <li>
                                        <marquee class="marquee" style="color: red">টুটুল ফার্নিচার গ্যালারীতে আপনাদের
                                            স্বাগতম । টুটুল এর ফার্নিচার নকলা,শেরপুর,ময়মনসিংহ । মোবাইলঃ <a
                                                href="javascript:void(0);">017-1870-0510</a> </marquee>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>




                                    <i class="fa fa-phone fa-lg"></i><a
                                        href="javascript:void(0);">(+88)017-1870-0510</a>


                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('home') }}" wire:navigate><img
                                src="{{ asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}"
                                alt="logo" /></a>
                    </div>
                    <div class="header-right">

                        <div class="search-style-1">
                            <form action="#">
                                <input type="text" wire:model.live.debounce.300ms="search" name="search"
                                    placeholder="Search for items..." />
                            </form>
                            <!-- Search Results Component -->
                        </div>
                        @if ($search != '')
                            <div class="search-results-container">
                                <div class="search-results-header">

                                    <h3>Search Results</h3>
                                    <span class="results-count">{{ $products_count }} items found</span>
                                    <div>
                                        <div>
                                            <a href="#"
                                                onclick="document.querySelector('.search-results-container').style.display='none'"><i
                                                    class="fi-rs-cross"></i></a>
                                        </div>
                                    </div>
                                </div>

                                @if ($products_count > 0)
                                    <ul class="search-results-list">
                                        @foreach ($products as $product)
                                            <li class="search-result-item">
                                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                                    wire:navigate class="product-link">
                                                    <div class="product-image">
                                                        @if ($product->image)
                                                            <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <div class="no-image-placeholder">
                                                                <i class="fas fa-image"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="product-details">
                                                        <h4 class="product-name">{{ $product->name }}</h4>
                                                        <div class="product-meta">
                                                            @if ($product->productDetail->discount_price)
                                                                <span
                                                                    class="product-price discounted">{{ $product->productDetail->regular_price }}
                                                                    Tk</span>
                                                                <span
                                                                    class="product-discount-price">{{ $product->productDetail->discount_price }}
                                                                    Tk</span>
                                                            @else
                                                                <span
                                                                    class="product-price">{{ $product->productDetail->regular_price }}
                                                                    Tk</span>
                                                            @endif

                                                            @if ($product->reviews->count() > 0)
                                                                @php
                                                                    $averageRating = round(
                                                                        $product->reviews->avg('rating'),
                                                                    );
                                                                @endphp

                                                                <div title="{{ $product->name }}" class="d-flex gap-1"
                                                                    style="margin-left: 50px;">
                                                                    <div style="font-size: 10px;">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <i
                                                                                class="fa fa-star {{ $i <= $averageRating ? 'checked' : '' }}"></i>
                                                                        @endfor
                                                                    </div>
                                                                    <div style="font-size: 12px; margin-bottom: 5px;">
                                                                        <span>{{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                                                                            / 5
                                                                            ({{ $product->reviews->count() }})
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        @if ($product->stock_status == 'instock')
                                                            <span class="stock-status in-stock">In Stock</span>
                                                        @else
                                                            <span class="stock-status out-of-stock">Out of
                                                                Stock</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach


                                    </ul>


                                    @if ($products->hasPages())
                                        <div class="search-pagination">
                                            {{ $products->links() }}
                                        </div>
                                    @endif
                                @else
                                    <div class="no-results">
                                        <div class="no-results-icon">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <h4>No matching products found</h4>
                                        <p>Try different keywords or browse our categories</p>
                                        <div class="search-suggestions">
                                            <h5>Popular searches:</h5>
                                            <div class="suggestion-tags">
                                                <a href="{{ route('shop', ['search' => 'sofa']) }}">Sofa</a>
                                                <a href="{{ route('shop', ['search' => 'chair']) }}">Chair</a>
                                                <a href="{{ route('shop', ['search' => 'table']) }}">Table</a>
                                                <a href="{{ route('shop', ['search' => 'bed']) }}">Bed</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif




                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="{{ route('wishlist') }}">
                                        <img class="svgInject" alt="Tutul Furniture"
                                            src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}" />
                                        <span id="wishlist-count"
                                            class="pro-count blue wishlist-count">{{ $wishlist_count }}</span>
                                    </a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('cart') }}" wire:navigate>
                                        <img alt="Tutul Furniture"
                                            src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}" />
                                        <span id="cart-count" class="pro-count blue">{{ $cart_count }}</span>
                                    </a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            @forelse($items as $index => $item)
                                                <li wire:key="cart-item-{{ $item->rowId }}">
                                                    <div class="shopping-cart-img">
                                                        <a href="product-javascript:void(0);"><img
                                                                alt="{{ $item->name }}"
                                                                src="{{ asset('storage/uploads/products/' . $item->options->image) }}" /></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4>
                                                            <a
                                                                href="product-javascript:void(0);">{{ $item->name }}</a>
                                                        </h4>
                                                        <h4><span>{{ $item->qty }} × </span>{{ $item->price }}
                                                        </h4>
                                                    </div>
                                                    <div class="shopping-cart-delete">
                                                        <a wire:click="removeItem('{{ $item->rowId }}')"><i
                                                                class="fi-rs-cross-small"></i></a>
                                                    </div>
                                                </li>
                                            @empty
                                                <p class="text-center">No item in cart</p>
                                            @endforelse


                                        </ul>
                                        <div class="shopping-cart-footer ">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span>${{ Cart::instance('cart')->total() }}</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('cart') }}" class="outline">View cart</a>
                                                <a href="javascript:void(0);"
                                                    class="{{ $items->count() == 0 ? 'd-none' : '' }}">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative" style="justify-content: space-around">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('home') }}" wire:navigate><img
                                src="{{ asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}"
                                alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span> Browse Categories</span>
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                    @forelse($categories as $index => $category)
                                        <li class="has-children">
                                            <a href="javascript:void(0);"><i
                                                    class="surfsidemedia-font-dress"></i>{{ $category->name }}</a>
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu d-lg-flex">
                                                    <li class="mega-menu-col col-lg-7">
                                                        <ul class="d-lg-flex">
                                                            <li class="mega-menu-col col-lg-6">
                                                                <ul>
                                                                    @forelse($category->subCategories as $index=> $subCategory)
                                                                        {{-- <li>
                                                                            <a class="dropdown-item nav-link nav_item"
                                                                                href="#">{{ $index + 1 }}:{{ $subCategory->name }}</a>
                                                                        </li> --}}

                                                                        <li>
                                                                            <a wire:navigate
                                                                                href="{{ route('shop', ['subcategory' => $subCategory->id]) }}">
                                                                                {{ $subCategory->name }}({{ $subCategory->products->count() }})
                                                                            </a>
                                                                        </li>
                                                                    @empty
                                                                        <li>No Subcategories</li>
                                                                    @endforelse

                                                                </ul>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                    {{-- <li class="mega-menu-col col-lg-5">
                                                        @forelse($category->subCategories as $index => $subCategory)
                                                            <div class="header-banner2">
                                                                <img src="{{ asset('storage/uploads/sub-categories/' . $subCategory->image) ?? 'https://en.ac-illust.com/clip-art/25480354/no-image-thumbnail-1-with-no-image' }}"
                                                                    alt="{{ $subCategory->name }}" height="100px"
                                                                    width="100px" />

                                                            </div>
                                                        @empty
                                                        @endforelse

                                                    </li> --}}
                                                </ul>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="has-children">
                                            <a href="javascript:void(0);"><i class="surfsidemedia-font-dress"></i>No
                                                Categories</a>
                                        </li>
                                    @endforelse


                                </ul>
                                <div class="more_categories" style="cursor: pointer">Show more...</div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}"
                                            href="{{ route('home') }}" wire:navigate>Home </a></li>
                                    <li><a href="javascript:void(0);">About</a></li>
                                    <li><a class="{{ request()->routeIs('shop') ? 'active' : '' }}"
                                            href="{{ route('shop') }}" wire:navigate>Shop</a></li>
                                    {{-- <li x-data="{ open: false }" class="position-static">
                                        <a href="#" @click="open = !open">Our Collections <i
                                                class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu" x-show="open" @click.away="open = false" x-transition>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Women's Fashion</a>
                                                <ul>
                                                    <li><a href="product-javascript:void(0);">Dresses</a></li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Blouses & Shirts</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Hoodies & Sweatshirts</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Wedding Dresses</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Prom Dresses</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Cosplay Costumes</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Men's Fashion</a>
                                                <ul>
                                                    <li><a href="product-javascript:void(0);">Jackets</a></li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Casual Faux Leather</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Genuine Leather</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Casual Pants</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Sweatpants</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Harem Pants</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Technology</a>
                                                <ul>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Gaming Laptops</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Ultraslim Laptops</a>
                                                    </li>
                                                    <li><a href="product-javascript:void(0);">Tablets</a></li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Laptop Accessories</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-javascript:void(0);">Tablet Accessories</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="product-javascript:void(0);"><img
                                                            src="assets/imgs/banner/menu-banner.jpg"
                                                            alt="Tutul Furniture" /></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br />
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="product-javascript:void(0);">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>35%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li><a href="javascript:void(0);">Blog </a></li>
                                    <li><a href="{{ route('contact') }}" wire:navigate>Contact</a></li>

                                    @guest
                                        <li>

                                            <a href="#">My Account<i class="fi-rs-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a class="{{ Route::is('login') ? 'active' : '' }}"
                                                        href="{{ route('login') }}" wire:navigate>Login</a></li>


                                            </ul>
                                        </li>
                                    @endguest

                                    @auth

                                        <li>

                                            <a href="#">{{ Auth::user()->name }}<i
                                                    class="fi-rs-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li>
                                                    @if (Auth::user()->role == 'admin')
                                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                                    @else
                                                        <a href="{{ route('customer.dashboard') }}">Dashboard</a>
                                                    @endif
                                                </li>
                                                {{-- <li><a href="#">Products</a></li>
                                                <li><a href="#">Categories</a></li>
                                                <li><a href="#">Coupons</a></li>
                                                <li><a href="#">Orders</a></li>
                                                <li><a href="#">Customers</a></li> --}}
                                                <li><a href="#" wire:click.prevent="logout">Logout</a></li>
                                            </ul>
                                        </li>
                                    @endauth


                                </ul>
                            </nav>
                        </div>
                    </div>
                    {{-- <div class="hotline d-none d-lg-block">
                        <p>
                            <i class="fi-rs-smartphone"></i><span>Toll Free</span> (+88)
                            017 187 005 10
                        </p>
                    </div> --}}
                    {{-- <p class="mobile-promotion">
                        Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to
                        40%
                    </p> --}}
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}" wire:navigate>
                                    <img alt="Tutul Furniture"
                                        src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span id="wishlist-count"
                                        class="pro-count white wishlist-count">{{ $wishlist_count }}</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart') }}" wire:navigate>
                                    <img alt="Tutul Furniture"
                                        src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span id="cart-count" class="pro-count white">{{ $cart_count }}</span>
                                </a>
                                {{-- <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-javascript:void(0);"><img alt="Tutul Furniture"
                                                        src="assets/imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4>
                                                    <a href="product-javascript:void(0);">Plain Striola Shirts</a>
                                                </h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-javascript:void(0);"><img alt="Tutul Furniture"
                                                        src="assets/imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4>
                                                    <a href="product-javascript:void(0);">Macbook Pro 2022</a>
                                                </h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="javascript:void(0);">View cart</a>
                                            <a href="shop-checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div onclick="document.getElementById('mobile-header-active').classList.toggle('show');"
                                    class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style" id="mobile-header-active" wire:ignore.self>
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('home') }}" wire:navigate><img
                            src="{{ asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}"
                            alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" wire:model.live.debounce.300ms="MoblieSearch" name="search"
                            placeholder="Search for items..." />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>

                @if ($MoblieSearch != '')
                    <div class="search-results-container">
                        <div class="search-results-header">

                            <h3>Search Results</h3>
                            <span class="results-count">{{ $MoblieProducts_count }} items found</span>
                            <div>
                                <div>
                                    <a href="#"
                                        onclick="document.querySelector('.search-results-container').style.display='none'"><i
                                            class="fi-rs-cross"></i></a>
                                </div>
                            </div>
                        </div>

                        @if ($MoblieProducts_count > 0)
                            <ul class="search-results-list">
                                @foreach ($MoblieProducts as $product)
                                    <li wire:key="{{ $product->id }}" class="search-result-item">
                                        <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                            wire:navigate class="product-link">
                                            <div class="product-image">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <div class="no-image-placeholder">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-details">
                                                <h4 class="product-name">{{ $product->name }}</h4>
                                                <div class="product-meta">
                                                    @if ($product->productDetail->discount_price)
                                                        <span
                                                            class="product-price discounted">{{ $product->productDetail->regular_price }}
                                                            Tk</span>
                                                        <span
                                                            class="product-discount-price">{{ $product->productDetail->discount_price }}
                                                            Tk</span>
                                                    @else
                                                        <span
                                                            class="product-price">{{ $product->productDetail->regular_price }}
                                                            Tk</span>
                                                    @endif


                                                </div>
                                                @if ($product->stock_status = 'instock')
                                                    <span class="stock-status in-stock">In Stock</span>
                                                @else
                                                    <span class="stock-status out-of-stock">Out of
                                                        Stock</span>
                                                @endif
                                                @if ($product->reviews->count() > 0)
                                                    @php
                                                        $averageRating = round($product->reviews->avg('rating'));
                                                    @endphp


                                                    <div style="font-size: 10px;">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fa fa-star {{ $i <= $averageRating ? 'checked' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div style="font-size: 12px; margin-bottom: 5px;">
                                                        <span>{{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                                                            / 5 ({{ $product->reviews->count() }})</span>
                                                    </div>
                                                @endif

                                            </div>
                                        </a>
                                    </li>
                                @endforeach


                            </ul>


                            @if ($products->hasPages())
                                <div class="search-pagination">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        @else
                            <div class="no-results">
                                <div class="no-results-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h4>No matching products found</h4>
                                <p>Try different keywords or browse our categories</p>
                                <div class="search-suggestions">
                                    <h5>Popular searches:</h5>
                                    <div class="suggestion-tags">
                                        <a href="{{ route('shop', ['search' => 'sofa']) }}">Sofa</a>
                                        <a href="{{ route('shop', ['search' => 'chair']) }}">Chair</a>
                                        <a href="{{ route('shop', ['search' => 'table']) }}">Table</a>
                                        <a href="{{ route('shop', ['search' => 'bed']) }}">Bed</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="mobile-menu-wrap mobile-header-border">
                    <div wire:ignore class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small bg-white shadow-md rounded-lg p-4 w-72"
                            x-data="{ openSubCategory: null }">
                            <ul class="space-y-2">
                                @forelse($categories as $index => $category)
                                    <li class="bg-gray-100 hover:bg-gray-200 rounded-lg p-3 cursor-pointer">
                                        <div class="flex justify-between items-center"
                                            @click="openSubCategory === {{ $category->id }} ? openSubCategory = null : openSubCategory = {{ $category->id }}">
                                            <span class="flex items-center text-gray-800 font-medium">
                                                <i class="surfsidemedia-font-dress mr-2"></i>
                                                {{ $index + 1 }}. {{ $category->name }}
                                            </span>
                                            <i class="fi-rs-angle-down transition-transform duration-300"
                                                style="float: right; margin-top: 6px;"
                                                :class="{ 'rotate-180': openSubCategory === {{ $category->id }} }"></i>
                                        </div>

                                        <!-- Subcategories -->
                                        <ul x-show="openSubCategory === {{ $category->id }}" x-collapse
                                            class="mt-2 ml-6 space-y-1">
                                            @forelse($category->subCategories as $index => $subCategory)
                                                <li class="p-2 bg-gray-50 hover:bg-gray-100 rounded-md text-gray-700">
                                                    <a wire:navigate
                                                        href="{{ route('shop', ['subcategory' => $subCategory->id]) }}">
                                                        <i class="surfsidemedia-font-dress mr-2 text-green-500"></i>
                                                        {{ $index + 1 }}.{{ $subCategory->name }}
                                                        ({{ $subCategory->products->count() }})
                                                    </a>
                                                </li>
                                            @empty
                                                <li class="text-sm text-gray-500 italic">No Sub Categories</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                @empty
                                    <li class="text-gray-500">No Categories Available</li>
                                @endforelse
                            </ul>
                        </div>

                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            @auth
                                @if (Auth::user()->role == 'admin')
                                    <li><a href="{{ route('admin.dashboard') }}" wire:navigate
                                            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('customer.dashboard') }}" wire:navigate
                                            class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">Dashboard</a>
                                    </li>
                                @endif
                            @else
                                <li><a href="{{ route('login') }}" wire:navigate
                                        class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
                            @endauth
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span><a href="{{ route('home') }}" wire:navigate
                                    class="{{ Request::routeIs('home') ? 'active' : '' }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span><a href="{{ route('shop') }}" wire:navigate
                                    class="{{ request()->routeIs('shop') ? 'active' : '' }}">shop</a>
                            </li>
                            {{-- <li class="menu-item-has-children">
                                <span class="menu-expand"></span><a href="#">Our Categories</a>
                                <ul class="dropdown">
                                    @forelse ($categories as $index=> $category)
                                        <li class="menu-item-has-children">
                                            <span class="menu-expand"></span><a
                                                href="#">{{ $category->name }}</a>
                                            <ul class="dropdown">
                                                @forelse ($category->subCategories as $index => $subCategory)
                                                    <li class="d-flex">

                                                        {{ $index + 1 }}.<a style="margin-top: 3px;"
                                                            href="javascript:void(0);">{{ $subCategory->name }}</a>

                                                    </li>
                                                @empty
                                                    <li><a href="javascript:void(0);">No Sub Categories</a>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </li>
                                    @empty
                                        <li><a href="javascript:void(0);">No Categories</a></li>
                                    @endforelse


                                </ul>
                            </li> --}}
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span><a href="javascript:void(0);">Blog</a>
                            </li>

                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a target="_blank" href="https://maps.app.goo.gl/zC9tW8wUARBDj9YF8"> Our location </a>
                    </div>
                    @guest
                        <div class="single-mobile-header-info">
                            <a href="{{ route('login') }}" wire:navigate>Log In / Sign Up </a>
                        </div>
                    @endguest

                    @auth
                        <div class="single-mobile-header-info">
                            <a href="javascript:void(0);">{{ Auth::user()->name }}</a>
                        </div>
                    @endauth
                    <div class="single-mobile-header-info">
                        <a href="javascript:void(0);"><i class="fa fa-phone fa-md"></i> (+88)017-1870-0510</a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="https://www.facebook.com/profile.php?id=100063479063866" target="_blank"><img
                            src="assets/imgs/theme/icons/icon-facebook.svg" alt="Tutul Furniture" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg"
                            alt="Tutul Furniture" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg"
                            alt="Tutul Furniture" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg"
                            alt="Tutul Furniture" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg"
                            alt="Tutul Furniture" /></a>
                </div>
            </div>
        </div>


    </div>

    <!-- Fixed Mobile Navigation Bar -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" wire:navigate class="nav-item {{ Route::is('home') ? 'active' : '' }}"
            id="home-btn">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        {{-- <a href="{{ route('wishlist') }}" wire:navigate class="nav-item">
            <div class="icon-container">
                <i class="fas fa-heart"></i>
                <span id="wishlist-count"
                    class="badge wishlist-count">{{ Cart::instance('wishlist')->count() }}</span>
            </div>
            <span>Wishlist</span>
        </a> --}}
        <a href="{{ route('shop') }}" wire:navigate class="nav-item {{ Route::is('shop') ? 'active' : '' }}">
            <div class="icon-container">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <span>Shop</span>
        </a>
        <a role="button" href="javascript:void(0)" class="nav-item manu-bars-mobile ">
            <div class="icon-container">
                <i class="fas fa-search"></i>
            </div>
            <span>Search</span>
        </a>
        <a wire:navigate href="{{ route('contact') }}"
            class="nav-item {{ Route::is('contact') ? 'active' : '' }} ">
            <div class="icon-container">
                <i class="fas fa-phone"></i>
            </div>
            <span>Contact</span>
        </a>
        <a role="button" href="#" class="nav-item manu-bars-mobile">
            <i class="fas fa-bars"></i>
            <span>Menu</span>
        </a>
        @guest
            <a href="{{ route('login') }}" wire:navigate class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Log In</span>
            </a>
        @else
            <a onclick="logout()" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>{{ Auth::user()->name }}-Logout</span>
            </a>
        @endguest

    </div>
    {{--
    <!-- Menu Drawer -->
    <div class="menu-drawer" id="menu-drawer">
        <div class="menu-drawer-header">
            <div class="menu-drawer-logo">
                <img src="{{ asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}" alt="Tutul Furniture">
            </div>
            <button class="menu-close" id="menu-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="menu-drawer-content">
            <div class="menu-categories">
                <h3 style="margin-bottom: 15px;">Categories</h3>
                <div class="menu-category">
                    <div class="menu-category-header" onclick="toggleSubcategories(this)">
                        <span><i class="fas fa-couch"></i> Living Room</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="menu-subcategories">
                        <div class="menu-subcategory">Sofas</div>
                        <div class="menu-subcategory">Coffee Tables</div>
                        <div class="menu-subcategory">TV Units</div>
                    </div>
                </div>
                <div class="menu-category">
                    <div class="menu-category-header" onclick="toggleSubcategories(this)">
                        <span><i class="fas fa-bed"></i> Bedroom</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="menu-subcategories">
                        <div class="menu-subcategory">Beds</div>
                        <div class="menu-subcategory">Wardrobes</div>
                        <div class="menu-subcategory">Dressers</div>
                    </div>
                </div>
                <div class="menu-category">
                    <div class="menu-category-header" onclick="toggleSubcategories(this)">
                        <span><i class="fas fa-utensils"></i> Dining</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="menu-subcategories">
                        <div class="menu-subcategory">Dining Tables</div>
                        <div class="menu-subcategory">Dining Chairs</div>
                        <div class="menu-subcategory">Buffets & Cabinets</div>
                    </div>
                </div>
            </div>
            <ul class="menu-nav">
                <li class="menu-nav-item active"><a href="#">Home</a></li>
                <li class="menu-nav-item"><a href="#">Shop</a></li>
                <li class="menu-nav-item"><a href="#">About</a></li>
                <li class="menu-nav-item"><a href="#">Blog</a></li>
                <li class="menu-nav-item"><a href="#">Contact</a></li>
                <li class="menu-nav-item"><a href="#">Login / Sign Up</a></li>
            </ul>
            <div style="margin-top: 20px;">
                <p><i class="fas fa-phone"></i> (+88)017-1870-0510</p>
                <p style="margin-top: 10px;"><i class="fas fa-map-marker-alt"></i> Tutul Furniture Gallery, Nokla,
                    Sherpur, Mymensingh</p>
            </div>
        </div>
    </div> --}}
    {{--
    <!-- Search Bar -->
    <div class="search-bar" id="search-bar">
        <form class="search-form">
            <input type="text" class="search-input" placeholder="Search for items...">
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
            <button type="button" class="search-close" id="search-close"><i class="fas fa-times"></i></button>
        </form>
    </div> --}}

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    <style>
        /* Fixed Mobile Navigation */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            z-index: 1000;
            display: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #666;
            font-size: 12px;
        }

        .nav-item.active {
            color: #f15412;
        }

        .nav-item i {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .badge {
            position: absolute;
            top: 0;
            right: -5px;
            background-color: #f15412;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            font-weight: bold;
        }

        .icon-container {
            position: relative;
        }

        @media (max-width: 1024px) {

            /* Fixed Mobile Navigation */
            .mobile-nav {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: #ffffff;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-around;
                align-items: center;
                padding: 10px 0;
                z-index: 1000;

            }

            .nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-decoration: none;
                color: #666;
                font-size: 12px;
            }

            .nav-item.active {
                color: #f15412;
            }

            .nav-item i {
                font-size: 20px;
                margin-bottom: 5px;
            }

            .badge {
                position: absolute;
                top: 0;
                right: -5px;
                background-color: #f15412;
                color: white;
                border-radius: 50%;
                width: 18px;
                height: 18px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 10px;
                font-weight: bold;
            }

            .icon-container {
                position: relative;
            }
        }

        /*
        .menu-drawer {
            position: fixed;
            top: 0;
            left: -100%;
            width: 80%;
            height: 100%;
            background-color: #fff;
            z-index: 1001;
            transition: left 0.3s ease;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .menu-drawer.open {
            left: 0;
        }

        .menu-drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .menu-drawer-logo img {
            max-height: 40px;
        }

        .menu-close {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .menu-drawer-content {
            padding: 20px;
        }

        .menu-categories {
            margin-bottom: 20px;
        }

        .menu-category {
            margin-bottom: 15px;
        }

        .menu-category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            cursor: pointer;
        }

        .menu-subcategories {
            display: none;
            padding-left: 20px;
            margin-top: 10px;
        }

        .menu-subcategories.open {
            display: block;
        }

        .menu-subcategory {
            padding: 8px 10px;
            margin-bottom: 5px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        .menu-nav {
            list-style: none;
        }

        .menu-nav-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .menu-nav-item a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .menu-nav-item.active a {
            color: #f15412;
        } */

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }

        .overlay.open {
            display: block;
        }

        /* Search bar */
        /* .search-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
            display: none;
        }

        .search-bar.open {
            display: block;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-button {
            background-color: #f15412;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
        }

        .header-marquee {
            display: inline-block;
            animation: marquee 10s linear infinite;
        } */

        .header-marquee:hover {
            animation-play-state: paused;
        }
    </style>



    <script>
        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of your account.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('logout');

                }
            })
        }

        function mobileHeaderActive2() {
            var navbarTrigger = $(".manu-bars-mobile"),
                endTrigger = $(".mobile-menu-close"),
                container = $(".mobile-header-active"),
                wrapper = $("body"); // Renamed variable

            if (!$(".body-overlay-1").length) {
                wrapper.prepend('<div class="body-overlay-1"></div>');
            }
            var overlay = $(".body-overlay-1"); // Cache the overlay

            navbarTrigger.on("click", function(e) {
                e.preventDefault();
                container.addClass("sidebar-visible");
                wrapper.addClass("mobile-menu-active");
                overlay.fadeIn(); // Show overlay
            });

            function closeMobileMenu() {
                container.removeClass("sidebar-visible");
                wrapper.removeClass("mobile-menu-active");
                overlay.fadeOut(); // Hide overlay
            }

            endTrigger.on("click", closeMobileMenu);
            overlay.on("click", closeMobileMenu); // Use the cached overlay selector
        }

        document.addEventListener('DOMContentLoaded', mobileHeaderActive2);
        document.addEventListener('livewire:navigated', mobileHeaderActive2);
    </script>

</div>

@section('title', 'Home')

<div>
    <main class="main">
        {{-- <div class="loader" id="loader">
            <div class="spinner"></div>
        </div> --}}

        <section wire:ignore class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @forelse($sliders as $index => $slider)
                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6">
                                    <div class="hero-slider-content-2">
                                        <h4 class="animated">{{ $slider->tagline }}</h4>

                                        <h1 class="animated fw-900 text-brand">{{ $slider->title }}</h1>
                                        <p class="animated">{{ $slider->subtitle }}</p>
                                        <a class="animated btn btn-brush btn-brush-3" href="{{ $slider->link }}"> Shop
                                            Now
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated slider-1-1"
                                            src="{{ asset('storage/uploads/sliders/' . $slider->image) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6">
                                    <div class="hero-slider-content-2">
                                        <h4 class="animated">Save 15% on</h4>
                                        <h1 class="animated fw-900 text-brand">New Arrivals</h1>
                                        <p class="animated">Save 15% on selected items in the online store</p>
                                        <a class="animated btn btn-brush btn-brush-3" href="shop.html"> Shop Now
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated slider-1-1" src="assets/imgs/slider/slider-1.png"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse


            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>


        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>New</span> Arrivals</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows">
                    </div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @forelse ($new_arrivals as $new_arrival)
                            @if ($new_arrival->is_active == 1)
                                <div wire:key='{{ $new_arrival->id }}' class="product-cart-wrap small hover-up"
                                    wire:ignore>
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details', ['slug' => $new_arrival->slug]) }}">
                                                <img class="default-img"
                                                    src="{{ asset('storage/uploads/products/' . $new_arrival->image) }}"
                                                    alt="{{ $new_arrival->name }}">
                                                @php
                                                    $images = $new_arrival->gallery_images;
                                                @endphp
                                                @if ($images)
                                                    @foreach ($images as $image)
                                                        <img class="hover-img"
                                                            src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                            alt="{{ $new_arrival->name }}">
                                                    @endforeach
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-action-1"
                                            style="@if (Cart::instance('wishlist')->content()->where('id', $new_arrival->id)->count() > 0) opacity: 1 !important; visibility: visible !important; @endif">
                                            <a aria-label="Quick view" class="action-btn small hover-up"
                                                href="{{ route('product.details', ['slug' => $new_arrival->slug]) }}"
                                                wire:navigate>
                                                <i class="fi-rs-eye"></i></a>

                                            <a aria-label="Add To Wishlist"
                                                class="action-btn small hover-up wishlist-toggle"
                                                data-id="{{ $new_arrival->id }}"
                                                data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $new_arrival->id)->first()->rowId ?? null }}"
                                                data-name="{{ $new_arrival->name }}"
                                                data-slug="{{ $new_arrival->slug }}"
                                                data-price="{{ $new_arrival->productDetail->discount_price ? $new_arrival->productDetail->discount_price : $new_arrival->productDetail->regular_price }}"
                                                data-image="{{ $new_arrival->image }}"><i class="fi-rs-heart"></i></a>




                                            <a aria-label="Compare" class="action-btn small hover-up" href="#"
                                                tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">new</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a wire:navigate
                                                href="{{ route('product.details', ['slug' => $new_arrival->slug]) }}">{{ $new_arrival->name }}</a>
                                        </h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            @if ($new_arrival->productDetail->discount_price)
                                                <span>৳{{ $new_arrival->productDetail->discount_price }} </span>
                                                <span
                                                    class="old-price">৳{{ $new_arrival->productDetail->regular_price }}</span>
                                            @else
                                                <span>৳{{ $new_arrival->productDetail->regular_price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-lg-12">
                                <marquee behavior="alternate" direction=" scrollamount=3"><span style="color: red">
                                        No New Arrivals</span></marquee>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Popular</span> Categories ( See All)</h3>
                <div wire:ignore class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-1-arrows">
                    </div>
                    <div class="carausel-6-columns" id="carausel-6-columns-1">
                        @forelse ($categories as $category)
                            <div class="card-1">
                                <figure class="img-hover-scale overflow-hidden" style="width: auto; height: 200px;">
                                    <a wire:navigate href="{{ route('shop', ['category' => $category->id]) }}">
                                        <img src="{{ $category->image ? asset('public/storage/uploads/categories/' . $category->image) : asset('assets/imgs/page/330px-No-Image-Placeholder.svg.jpg') }}"
                                            alt="{{ $category->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </figure>
                                <h5><a wire:navigate
                                        href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </h5>
                            </div>
                        @empty
                            <div class="card-1">
                                <figure class="img-hover-scale overflow-hidden" style="width: 200px; height: 200px;">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/imgs/page/330px-No-Image-Placeholder.svg.jpg') }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </figure>
                                <h5><a href="javascript:void(0);">No Categories Available</a></h5>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>


        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Popular</span> Sub Categories</h3>
                <div wire:ignore class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                        id="carausel-6-columns-2-arrows">
                    </div>
                    <div class="carausel-6-columns" id="carausel-6-columns-2">
                        @forelse ($subcategories as $category)
                            <div class="card-1">
                                <figure class="img-hover-scale overflow-hidden" style="width: auto; height: 200px;">
                                    <a wire:navigate href="{{ route('shop', ['subcategory' => $category->id]) }}">
                                        <img src="{{ $category->image ? asset('public/storage/uploads/sub-categories/' . $category->image) : asset('assets/imgs/page/330px-No-Image-Placeholder.svg.jpg') }}"
                                            alt="{{ $category->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </figure>
                                <h5><a wire:navigate
                                        href="{{ route('shop', ['subcategory' => $category->id]) }}">{{ $category->name }}</a>
                                </h5>
                            </div>
                        @empty
                            <div class="card-1">
                                <figure class="img-hover-scale overflow-hidden" style="width: 200px; height: 200px;">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('assets/imgs/page/330px-No-Image-Placeholder.svg.jpg') }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </figure>
                                <h5><a href="javascript:void(0);">No Categories Available</a></h5>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>

        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true">Featured</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                type="button" role="tab" aria-controls="tab-two"
                                aria-selected="false">Popular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab"
                                data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three"
                                aria-selected="false">New
                                added</button>
                        </li>
                    </ul>
                    <a href="{{ route('shop') }}" wire:navigate class="view-more d-none d-md-flex">View More<i
                            class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @forelse($featured_products as $index => $featured_product)

                                @if ($featured_product->is_active == 1)
                                    @php
                                        $uniqueId = 'furnitureModal_' . $featured_product->id;
                                    @endphp
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="javascript:void(0)">
                                                        <img class="default-img" wire:navigate
                                                            src="{{ asset('storage/uploads/products/' . $featured_product->image) }}"
                                                            alt="">

                                                        @php
                                                            $images = $featured_product->gallery_images;
                                                        @endphp

                                                        @if ($images)
                                                            @foreach ($images as $image)
                                                                <img class="hover-img"
                                                                    src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                                    alt="">
                                                            @endforeach
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="product-action-1"
                                                    style="@if (Cart::instance('wishlist')->content()->where('id', $featured_product->id)->count() > 0) opacity: 1 !important;  visibility: visible !important; @endif">
                                                    <a href="{{ route('product.details', ['slug' => $featured_product->slug]) }}"
                                                        wire:navigate aria-label="Quick view"
                                                        class="action-btn hover-up">
                                                        <i class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist"
                                                        class="action-btn hover-up wishlist-toggle"
                                                        data-id="{{ $featured_product->id }}"
                                                        data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $featured_product->id)->first()->rowId ?? null }}"
                                                        data-name="{{ $featured_product->name }}"
                                                        data-slug="{{ $featured_product->slug }}"
                                                        data-price="{{ $featured_product->productDetail->discount_price ? $featured_product->productDetail->discount_price : $featured_product->productDetail->regular_price }}"
                                                        data-image="{{ $featured_product->image }}">
                                                        @if (Cart::instance('wishlist')->content()->where('id', $featured_product->id)->count() > 0)
                                                            <i class="fa-solid fa-heart fa-lg"></i>
                                                        @else
                                                            <i class="fa-regular fa-heart fa-lg"></i>
                                                        @endif
                                                    </a>
                                                    {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    wire:click='addToWishlist({{ $product->id }})'><i
                                                        class="fi-rs-heart"></i></a> --}}

                                                    {{-- <a aria-label="Compare" class="action-btn hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a> --}}
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">featured</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a wire:navigate
                                                        href="{{ route('shop', ['category' => $featured_product->category->id]) }}">{{ $featured_product->category->name }}</a>
                                                </div>
                                                <div class="product-category">
                                                    <a wire:navigate
                                                        href="{{ route('shop', ['subcategory' => $featured_product->subCategory->id]) }}">{{ $featured_product->subCategory->name }}</a>
                                                </div>
                                                <h2>
                                                    <a href="{{ route('product.details', ['slug' => $featured_product->slug]) }}"
                                                        wire:navigate>{{ $featured_product->name }}</a>
                                                </h2>
                                                @php
                                                    $averageRating = round($featured_product->reviews->avg('rating'));
                                                @endphp

                                                <div title="{{ $featured_product->name }}" class="d-flex gap-1">
                                                    <div style="font-size: 10px;">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fa fa-star {{ $i <= $averageRating ? 'checked' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div style="font-size: 12px; margin-bottom: 5px;">
                                                        <span>{{ number_format($featured_product->reviews->avg('rating') ?? 0, 1) }}
                                                            / 5</span>
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    @if ($featured_product->productDetail->discount_price)
                                                        <span>${{ $featured_product->productDetail->discount_price }}</span>
                                                        <span
                                                            class="old-price">${{ $featured_product->productDetail->regular_price }}</span>
                                                    @else
                                                        <span>${{ $featured_product->productDetail->regular_price }}</span>
                                                    @endif
                                                </div>

                                                {{-- ? cart Button --}}
                                                <div class="product-action-1 show">
                                                    @if (Cart::instance('cart')->content()->where('id', $featured_product->id)->count() > 0)
                                                        <a href="{{ route('cart') }}" wire:navigate>
                                                            <button aria-label="go to cart"
                                                                class="action-btn hover-up cart-icon"
                                                                style="display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>

                                                        </a>
                                                    @else
                                                        <button aria-label="Add To Cart" data-bs-toggle="modal"
                                                            data-bs-target="#{{ $uniqueId }}"
                                                            class="action-btn hover-up"><i
                                                                class="fi-rs-shopping-bag-add"></i></button>
                                                    @endif
                                                </div>


                                                {{-- ! Cart Modal --}}

                                                <div wire:preserve-scroll class="modal fade" id="{{ $uniqueId }}"
                                                    tabindex="-1" aria-labelledby="furnitureModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="furnitureModalLabel">Add
                                                                    to card
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <!-- Image Section -->
                                                                    <div class="col-md-6">
                                                                        <img src="{{ asset('storage/uploads/products/' . $featured_product->image) }}"
                                                                            class="img-fluid modal-img"
                                                                            alt="Premium Sofa">
                                                                    </div>
                                                                    <!-- Details Section -->
                                                                    <div class="col-md-6">
                                                                        <span class="premium-badge">Premium
                                                                            Collection</span>
                                                                        @if ($featured_product->productDetail->discount_price)
                                                                            <h4 class="mt-3">
                                                                                ${{ $featured_product->productDetail->discount_price }}
                                                                            </h4>

                                                                            <s>${{ $featured_product->productDetail->regular_price }}</s>
                                                                        @else
                                                                            <h4 class="mt-3">
                                                                                ${{ $featured_product->productDetail->regular_price }}
                                                                            </h4>
                                                                        @endif
                                                                        <p class="text-muted">
                                                                            @if ($featured_product->productDetail->short_description)
                                                                                {!! $featured_product->productDetail->short_description !!}
                                                                            @else
                                                                                N/A
                                                                            @endif

                                                                        </p>
                                                                        <ul class="list-unstyled">
                                                                            <li><strong>Material:</strong>
                                                                                {{ $featured_product->productDetail->material }}
                                                                            </li>


                                                                            <li><strong>Features:</strong> Magnetic
                                                                                Connectors, Memory Foam Cushions</li>
                                                                            <li><strong>Colors:</strong> Midnight Blue,
                                                                                Charcoal Gray, Ivory Cream</li>
                                                                        </ul>
                                                                        <button
                                                                            wire:click='addToCart({{ $featured_product->id }})'
                                                                            data-bs-dismiss="modal"
                                                                            class="btn btn-primary w-100">Add to
                                                                            Cart</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a
                                                                    href="{{ route('product.details', $featured_product->slug) }}">
                                                                    <button type="button"
                                                                        class="btn btn-success">Learn
                                                                        More</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @empty

                                <div class="col-lg-12">
                                    No Products</div>
                            @endforelse

                        </div>
                        <!--End product-grid-4-->
                    </div>

                    {{-- Popular Product  --}}
                    {{-- <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-9-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-9-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="#"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Donec </a>
                                        </div>
                                        <h2><a href="product-details.html">Lorem ipsum dolor</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-10-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-10-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">New</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">Sed tincidunt interdum</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>50%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$138.85 </span>
                                            <span class="old-price">$255.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-11-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-11-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="best">Best Sell</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Watch</a>
                                        </div>
                                        <h2><a href="product-details.html">Fusce metus orci</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>95%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$338.85 </span>
                                            <span class="old-price">$445.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-12-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-12-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">Sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">Integer venenatis libero</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$123.85 </span>
                                            <span class="old-price">$235.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-13-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-13-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">-30%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Speaker</a>
                                        </div>
                                        <h2><a href="product-details.html">Cras tempor orci id</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$28.85 </span>
                                            <span class="old-price">$45.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-14-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-14-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">-22%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Camera</a>
                                        </div>
                                        <h2><a href="product-details.html">Nullam cursus mi qui</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-15-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-15-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">New</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Phone</a>
                                        </div>
                                        <h2><a href="product-details.html">Fusce fringilla ultrices</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>98%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$1275.85 </span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-1-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Accessories </a>
                                        </div>
                                        <h2><a href="product-details.html">Sed sollicitudin est</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End product-grid-4-->
                    </div> --}}


                    {{-- Best Selling Product  --}}
                    {{-- <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="default-img" src="assets/imgs/shop/product-2-1.jpg"
                                                    alt="">
                                                <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">Donec ut nisl rutrum</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-3-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-3-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">New</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">Nullam dapibus pharetra</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>50%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$138.85 </span>
                                            <span class="old-price">$255.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-4-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-4-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="best">Best Sell</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Watch</a>
                                        </div>
                                        <h2><a href="product-details.html">Morbi dictum finibus</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>95%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$338.85 </span>
                                            <span class="old-price">$445.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-5-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-5-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">Sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">Nunc volutpat massa</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$123.85 </span>
                                            <span class="old-price">$235.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-6-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-6-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">-30%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Speaker</a>
                                        </div>
                                        <h2><a href="product-details.html">Nullam ultricies luctus</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$28.85 </span>
                                            <span class="old-price">$45.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-7-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-7-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">-22%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Camera</a>
                                        </div>
                                        <h2><a href="product-details.html">Nullam mattis enim</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-8-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-8-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">New</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Phone</a>
                                        </div>
                                        <h2><a href="product-details.html">Vivamus sollicitudin</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>98%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$1275.85 </span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="product-details.html">
                                                <img class="hover-img" src="assets/imgs/shop/product-9-1.jpg"
                                                    alt="">
                                                <img class="default-img" src="assets/imgs/shop/product-9-2.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i
                                                    class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Accessories </a>
                                        </div>
                                        <h2><a href="product-details.html"> Donec ut nisl rutrum</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>70%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End product-grid-4-->
                    </div> --}}

                </div>
                <!--End tab-content-->
            </div>
        </section>


        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="{{ asset('assets/imgs/banner/Screenshot 2025-05-03 000904.png') }}"
                                alt="">
                            <div class="banner-text">
                                <span style="color: wheat">Smart Offer</span>
                                <h4 style="color: wheat">Save 20% on <br>Woman Bag</h4>
                                <a href="{{ route('shop') }}" wire:navigate>Shop Now <i
                                        class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="{{ asset('assets/imgs/banner/Screenshot 2025-05-03 011029.png') }}"
                                alt="">
                            <div class="banner-text">
                                <span style="color: wheat">Sale off</span>
                                <h4 style="color: wheat">Great Summer <br>Collection</h4>
                                <a style="color: black; text-decoration: dashed;" href="{{ route('shop') }}"
                                    wire:navigate>Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated  mb-sm-0">
                            <img src="{{ asset('assets/imgs/banner/Screenshot 2025-05-03 000904.png') }}"
                                alt="">
                            <div class="banner-text">
                                <span>New Arrivals</span>
                                <h4>Shop Today’s <br>Deals & Offers</h4>
                                <a href="{{ route('shop') }}" wire:navigate>Shop Now <i
                                        class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Our</span> Brands</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                        id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        <div class="brand-logo">
                            <img class="img-grey-hover" style="cursor: zoom-in;"
                                src="{{ asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}"
                                alt="">
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>


</div>


@push('styles')
    <style>
        .fa-star.checked {
            color: orange;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(255, 255, 255);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;

        }

        .spinner {
            width: 350px;
            height: 350px;
            margin-top: 10%;
        }




        body {
            overflow-x: hidden;
        }
    </style>
@endpush


@push('scripts')
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content');

        function initWishlistToggle() {
            document.querySelectorAll('.wishlist-toggle').forEach(function(btn) {
                // Prevent double binding
                btn.removeEventListener('click', handleWishlistClick);
                btn.addEventListener('click', handleWishlistClick);
            });
        }

        function handleWishlistClick(e) {
            e.preventDefault();

            let btn = this;
            let icon = btn.querySelector('i');



            // Show loading spinner
            icon.outerHTML =
                `<img src="https://api.iconify.design/codex:loader.svg" alt="Loading"  />`;

            // Save original icon HTML to restore later
            let originalIcon = icon.outerHTML;

            let productId = btn.getAttribute('data-id');
            let name = btn.getAttribute('data-name');
            let slug = btn.getAttribute('data-slug');
            let price = btn.getAttribute('data-price');
            let image = btn.getAttribute('data-image');

            let isInWishlist = icon.classList.contains('fa-solid');

            let url = isInWishlist ? `/wishlist/remove-by-id/${productId}` : `/wishlist/add/${productId}`;
            let payload = isInWishlist ? {} : {
                id: productId,
                name: name,
                slug: slug,
                price: price,
                image: image
            };

            axios.post(url, payload)
                .then(function(response) {
                    let newIcon = isInWishlist ?
                        '<i class="fa-regular fa-heart fa-lg"></i>' :
                        '<i class="fa-solid fa-heart fa-lg text-danger"></i>';

                    btn.innerHTML = newIcon;

                    Livewire.dispatch('alert-success', response.data.message || 'Wishlist updated.');
                    const wishlistElements = document.querySelectorAll('.wishlist-count');
                    wishlistElements.forEach(el => {
                        el.textContent = response.data.wishlistCount;
                        // console.log(document.getElementById('wishlist-count')); // null না এলিমেন্ট দেখা উচিত
                        // console.log(response.data.wishlistCount); // সঠিক সংখ্যা আছে কিনা দেখুন
                    });


                })
                .catch(function(error) {
                    console.error('Wishlist error:', error);
                    btn.innerHTML = originalIcon; // Restore original icon if error
                });
        }

        // Initial load
        document.addEventListener('DOMContentLoaded', initWishlistToggle);
        // For SPA navigation
        document.addEventListener('livewire:navigated', initWishlistToggle);
    </script>
@endpush

@section('title', $Product_name)

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> {{ $Product_name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="product-gallery">
                                        <div class="main-image-container">
                                            <a id="zoomTrigger"
                                                href="{{ asset('storage/uploads/products/' . $product_image) }}"
                                                data-fancybox="product-gallery" class="main-image-wrapper zoom">
                                                <img id="mainProductImage"
                                                    src="{{ asset('storage/uploads/products/' . $product_image) }}"
                                                    alt="{{ $Product_name }}" class="main-product-image">

                                                <!-- Zoom Icon -->
                                                <div class="zoom-icon">
                                                    <!-- Your SVG remains unchanged -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65"
                                                            y2="16.65"></line>
                                                        <line x1="11" y1="8" x2="11"
                                                            y2="14"></line>
                                                        <line x1="8" y1="11" x2="14"
                                                            y2="11"></line>
                                                    </svg>
                                                </div>
                                            </a>

                                            <!-- Navigation Arrows -->
                                            <button class="gallery-nav prev-image">&#10094;</button>
                                            <button class="gallery-nav next-image">&#10095;</button>
                                        </div>

                                        <!-- Thumbnails -->
                                        <div class="thumbnail-strip">
                                            <a href="{{ asset('storage/uploads/products/' . $product_image) }}"
                                                data-fancybox="product-gallery" class="thumbnail-container active"
                                                data-src="{{ asset('storage/uploads/products/' . $product_image) }}">
                                                <img class="thumbnail-image"
                                                    src="{{ asset('storage/uploads/products/' . $product_image) }}"
                                                    alt="Product Image">
                                            </a>
                                            @foreach ($product_gallery_images as $index => $galleryImage)
                                                <a href="{{ asset('storage/uploads/products/gallery/' . $galleryImage) }}"
                                                    data-fancybox="product-gallery" class="thumbnail-container "
                                                    data-src="{{ asset('storage/uploads/products/gallery/' . $galleryImage) }}">
                                                    <img class="thumbnail-image"
                                                        src="{{ asset('storage/uploads/products/gallery/' . $galleryImage) }}"
                                                        alt="Product Gallery Image {{ $index + 1 }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Details Container (your existing code) -->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $Product_name }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Brands: <a href="shop.html">{{ $brand_name }}</a></span>
                                            </div>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating"
                                                        style="width: {{ ($all_reviews->avg('rating') / 5) * 100 }}%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    {{ number_format($all_reviews->avg('rating'), 1) }} / 5
                                                    ({{ $reviews_count }})
                                                    reviews
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @if ($discount_price)
                                                    <ins><span class="text-brand">৳{{ $regular_price }}</span></ins>
                                                    <ins><span
                                                            class="old-price font-md ml-15">${{ $discount_price }}</span></ins>
                                                    <span
                                                        class="save-price font-md color3 ml-15 text-danger">{{ $regular_price - $discount_price }}৳
                                                        Off</span>
                                                @else
                                                    <ins><span class="text-brand">৳{{ $regular_price }}</span></ins>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        @if ($short_description)
                                            <div class="short-desc mb-30">
                                                <p>{!! $short_description !!}</p>
                                            </div>
                                        @else
                                            <div class="short-desc mb-15">
                                                <p>N/A</p>
                                            </div>
                                        @endif
                                        <div class="bt-1 border-color-1 mt-30 mb-30">
                                            @if (Cart::instance('cart')->content()->where('id', $product_id)->count() > 0)
                                                <p class="text-success">Item already in cart</p>
                                            @endif
                                        </div>
                                        <div x-data="{ count: $wire.quantityInCart }" class="detail-extralink">
                                            <div class="detail-qty">
                                                <div class="quantity-selector">
                                                    <button class="quantity-btn" wire:loading.attr="disabled"
                                                        @click="if(count > 1) count-- ; $wire.quantityInCart = count">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="quantity-value" x-text="count"></span>
                                                    <button class="quantity-btn" wire:loading.attr="disabled"
                                                        @click="count++ ; $wire.quantityInCart = count">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-extra-link2 d-flex">

                                                <form wire:submit.prevent='addToCart({{ $product_id }})'>
                                                    <button @click="count = 1" type="submit"
                                                        class="button button-add-to-cart">Add to
                                                        cart</button>
                                                </form>
                                                <a aria-label="Add To Wishlist"
                                                    class="action-btn hover-up wishlist-toggle"
                                                    data-id="{{ $product_id }}"
                                                    data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $product_id)->first()->rowId ?? null }}"
                                                    data-name="{{ $Product_name }}" data-slug="{{ $slug }}"
                                                    data-price="{{ $discount_price ? $discount_price : $regular_price }}"
                                                    data-image="{{ $product_image }}">
                                                    @if (Cart::instance('wishlist')->content()->where('id', $product_id)->count() > 0)
                                                        <i class="fa-solid fa-heart fa-lg text-danger"></i>
                                                    @else
                                                        <i class="fa-regular fa-heart fa-lg"></i>
                                                    @endif
                                                </a>

                                                {{-- <a aria-label="Compare" class="action-btn hover-up"
                                                    href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a> --}}
                                            </div>
                                        </div>
                                        <div class="product-details" style=" margin-top: 20px;">
                                            <div class="product-meta">
                                                <strong>SKU: </strong><span>{{ $SKU }}</span>
                                            </div>

                                            @if ($materials)
                                                <div class="product-meta">
                                                    <strong>Materials: </strong><span>{{ $materials }}</span>
                                                </div>
                                            @endif

                                            @if ($dimensions['width'] && $dimensions['height'] && $dimensions['length'] !== '')
                                                <div class="product-meta">
                                                    <strong>Dimensions: </strong>
                                                    @foreach ($dimensions as $key => $value)
                                                        <span class="dimension">
                                                            {{ $key }}: {{ $value }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="product-meta">
                                                <strong>Availability: </strong>
                                                <span class="in-stock text-success">{{ $quantity }} Items In
                                                    Stock</span>
                                            </div>


                                        </div>

                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                            href="#Reviews">Reviews (3)</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div>
                                            @if ($description)
                                                <p>{!! $description !!}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-60">
                                <section class="section-padding">
                                    <div class="container" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <h3 class="section-title style-1 mb-30">Reviews
                                                ({{ \App\Models\Review::where('product_id', $product_id)->count() }})
                                            </h3>

                                            <div class="row" id="review-section" x-data x-init="window.addEventListener('scroll-to-review', () => {
                                                $el.scrollIntoView({ behavior: 'smooth' });
                                            });">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    @forelse($reviews as $index => $review)
                                                        <div class="comment-list">
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png"
                                                                            alt="">
                                                                        <h6><a
                                                                                href="#">{{ $review->user->name }}</a>
                                                                        </h6>
                                                                        <p class="font-xxs">
                                                                            {{ $review->created_at->format('M d, Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="desc">

                                                                        @php
                                                                            $rating = $review->rating;
                                                                        @endphp

                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $rating)
                                                                                <span
                                                                                    style="color: #ED8919;">&#9733;</span>
                                                                                {{-- Filled Star --}}
                                                                            @else
                                                                                <span
                                                                                    style="color: lightgray;">&#9733;</span>
                                                                                {{-- Empty Star --}}
                                                                            @endif
                                                                        @endfor
                                                                        <div
                                                                            style=" word-wrap: break-word; overflow-wrap: break-word; word-break: break-all; ">
                                                                            <p>{{ $review->review }}</p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30">
                                                                                    {{ $review->created_at->format('d M Y, h:i A') }}
                                                                                </p>
                                                                                <a href="#"
                                                                                    class="text-brand btn-reply">Reply
                                                                                    <i class="fi-rs-arrow-right"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <h1>No Review</h1>
                                                    @endforelse
                                                    {{ $reviews->links(data: ['scrollTo' => false]) }}
                                                </div>
                                                @php
                                                    $total = $all_reviews->count();
                                                @endphp

                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating"
                                                                style="width: {{ ($all_reviews->avg('rating') / 5) * 100 }}%">
                                                            </div>
                                                        </div>
                                                        <h6>{{ number_format($all_reviews->avg('rating'), 1) }} / 5
                                                        </h6>
                                                    </div>

                                                    @foreach (range(5, 1) as $star)
                                                        @php
                                                            $count = $all_reviews->where('rating', $star)->count();
                                                            $percent = $total > 0 ? round(($count / $total) * 100) : 0;
                                                        @endphp
                                                        <div class="progress mb-2">
                                                            <span>{{ $star }} star</span>
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $percent }}%;"
                                                                aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $count }}
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <a href="#" class="font-xs text-muted">How are ratings
                                                        calculated?</a>
                                                </div>

                                            </div>
                                        </div>


                                        <!--comment form-->
                                        <div class="comment-form" x-data="{ open: false, rating: 0 }">
                                            <button style="background: #398183; border: none;" @click="open = !open"
                                                style="cursor: pointer" class="mb-15 btn">
                                                Add a review <i class="fa fa-plus"></i>
                                            </button>

                                            @auth
                                                <div class="row" x-show="open" x-cloak x-transition>
                                                    <div class="col-lg-8 col-md-12">
                                                        <form class="form-contact comment_form"
                                                            wire:submit.prevent='reviewSave' id="commentForm">
                                                            <!-- Star Rating -->
                                                            <div x-data="{ rating: @entangle('rating') }" class="mb-3">
                                                                <label class="form-label">Your Rating:</label>
                                                                <div>
                                                                    <template x-for="star in 5" :key="star">
                                                                        <i class="fa-star fa-2x me-1 cursor-pointer"
                                                                            :class="star <= rating ? 'fas text-warning' :
                                                                                'far text-secondary'"
                                                                            @click="rating = star; $wire.rating = star">
                                                                        </i>
                                                                    </template>
                                                                </div>

                                                                <p class="text-danger"> {{ $errors->first('rating') }}</p>

                                                            </div>

                                                            <!-- Comment Field -->
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <textarea wire:model='review' class="form-control w-100" name="comment" id="comment" cols="30"
                                                                            rows="5" placeholder="Write Comment"></textarea>
                                                                    </div>
                                                                    <p class="text-danger">{{ $errors->first('review') }}
                                                                    </p>
                                                                </div>

                                                                {{-- <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name"
                                                                        id="name" type="text"
                                                                        placeholder="Name">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email"
                                                                        id="email" type="email"
                                                                        placeholder="Email">
                                                                </div>
                                                            </div> --}}

                                                                {{-- <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="website"
                                                                        id="website" type="text"
                                                                        placeholder="Website">
                                                                </div>
                                                            </div> --}}
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <button type="submit"
                                                                    class="button button-contactForm">Submit
                                                                    Review</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <div x-show="open" x-cloak x-transition>
                                                    <a href="{{ route('login') }}" wire:navigate>
                                                        <p class="text-danger">Please login to add review</p>
                                                    </a>
                                                </div>
                                            @endauth
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Related products</h3>
                                </div>
                                <section class="section-padding">
                                    <div class="container wow fadeIn animated">
                                        {{-- <h3 class="section-title mb-20"><span>Releted</span> Products</h3> --}}
                                        <div class="carausel-6-columns-cover position-relative">
                                            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                                                id="carausel-6-columns-2-arrows">
                                            </div>
                                            <div class="carausel-6-columns carausel-arrow-center"
                                                id="carausel-6-columns-2">
                                                @forelse ($related_products as $related_product)
                                                    @if ($related_product->is_active == 1)
                                                        <div wire:key='{{ $related_product->id }}'
                                                            style="width: 300px !important;"
                                                            class="product-cart-wrap small hover-up" wire:ignore>
                                                            <div class="product-img-action-wrap">
                                                                <div class="product-img product-img-zoom">
                                                                    <a
                                                                        href="{{ route('product.details', ['slug' => $related_product->slug]) }}">
                                                                        <img class="default-img"
                                                                            src="{{ asset('storage/uploads/products/' . $related_product->image) }}"
                                                                            alt="{{ $related_product->name }}">
                                                                        @php
                                                                            $images = $related_product->gallery_images;
                                                                        @endphp
                                                                        @if ($images)
                                                                            @foreach ($images as $image)
                                                                                <img class="hover-img"
                                                                                    src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                                                    alt="{{ $related_product->name }}">
                                                                            @endforeach
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="product-action-1"
                                                                    style="@if (Cart::instance('wishlist')->content()->where('id', $related_product->id)->count() > 0) opacity: 1 !important; visibility: visible !important; @endif">
                                                                    <a aria-label="Quick view"
                                                                        class="action-btn small hover-up"
                                                                        href="{{ route('product.details', ['slug' => $related_product->slug]) }}"
                                                                        wire:navigate>
                                                                        <i class="fi-rs-eye"></i></a>

                                                                    <a aria-label="Add To Wishlist"
                                                                        class="action-btn small hover-up wishlist-toggle"
                                                                        data-id="{{ $related_product->id }}"
                                                                        data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $related_product->id)->first()->rowId ?? null }}"
                                                                        data-name="{{ $related_product->name }}"
                                                                        data-slug="{{ $related_product->slug }}"
                                                                        data-price="{{ $related_product->productDetail->discount_price ? $related_product->productDetail->discount_price : $related_product->productDetail->regular_price }}"
                                                                        data-image="{{ $related_product->image }}"><i
                                                                            class="fi-rs-heart"></i></a>





                                                                </div>
                                                                <div
                                                                    class="product-badges product-badges-position product-badges-mrg">
                                                                    <span class="new">new</span>
                                                                </div>
                                                            </div>
                                                            <div class="product-content-wrap">
                                                                <h2><a wire:navigate
                                                                        href="{{ route('product.details', ['slug' => $related_product->slug]) }}">{{ $related_product->name }}</a>
                                                                </h2>
                                                                <div class="rating-result" title="90%">
                                                                    <span>
                                                                    </span>
                                                                </div>
                                                                <div class="product-price">
                                                                    @if ($related_product->productDetail->discount_price)
                                                                        <span>৳{{ $related_product->productDetail->discount_price }}
                                                                        </span>
                                                                        <span
                                                                            class="old-price">৳{{ $related_product->productDetail->regular_price }}</span>
                                                                    @else
                                                                        <span>৳{{ $related_product->productDetail->regular_price }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="col-lg-12">
                                                        <marquee behavior="alternate" direction=" scrollamount=3">
                                                            <span style="color: red">
                                                                No Releted Products</span>
                                                        </marquee>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
</div>
</section>
</main>
</div>


@push('styles')
    <style>
        .product-gallery {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .main-image-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
        }

        .main-image-wrapper {
            position: relative;
            display: block;
            width: 100%;
        }

        .main-product-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .zoom-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .zoom-icon:hover {
            background: rgba(255, 255, 255, 0.9);
        }

        .zoom-icon svg {
            width: 24px;
            height: 24px;
            stroke: #333;
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .prev-image {
            left: 10px;
        }

        .next-image {
            right: 10px;
        }

        .thumbnail-strip {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            overflow-x: auto;
            padding: 5px 0;
        }

        .thumbnail-container {
            width: 60px;
            height: 60px;
            border: 2px solid transparent;
            border-radius: 4px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .thumbnail-container.active {
            border-color: #007bff;
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        :root {
            --primary: #3a86ff;
            --secondary: #ff006e;
            --success: #38b000;
            --danger: #d90429;
            --dark: #212529;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #dee2e6;
            --border-radius: 8px;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }


        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            width: fit-content;
            margin: 0 auto;
        }

        .quantity-btn {
            padding: 6px 12px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            color: var(--dark);
        }

        .quantity-btn:hover {
            color: var(--primary);
        }

        .quantity-value {
            padding: 0 16px;
            font-weight: 600;
            min-width: 48px;
            text-align: center;
        }

        // metails
        .product-details {

            display: flex;
            flex-direction: column;
            gap: 20px;
            font-size: 14px;
            color: #333;
        }

        .product-meta {
            margin-bottom: 10px;
        }

        .product-meta strong {
            font-weight: bold;
            color: #000;
        }

        .product-meta span {
            margin-left: 10px;
            color: #555;
        }

        .dimension {
            margin-right: 15px;
            font-size: 14px;
        }

        .product-actions button {
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        .product-actions .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .product-actions .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .product-actions .btn:hover {
            opacity: 0.8;
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
    <script>
        function imagesInit() {
            // Destroy previous Fancybox instance to avoid duplication
            Fancybox.destroy();

            // Reinitialize Fancybox
            Fancybox.bind("[data-fancybox='product-gallery']", {
                infinite: false,
                Thumbs: {
                    autoStart: true,
                },
                Toolbar: {
                    display: {
                        left: ['prev', 'next'],
                        middle: ['zoomIn', 'zoomOut', 'toggle1to1', 'rotateCCW', 'rotateCW'],
                        right: ['close']
                    }
                }
            });

            const mainImage = document.getElementById('mainProductImage');
            const zoomLink = document.getElementById('zoomTrigger');
            const thumbnails = document.querySelectorAll('.thumbnail-container');
            const prevButton = document.querySelector('.prev-image');
            const nextButton = document.querySelector('.next-image');

            let currentIndex = 0;

            const updateMainImage = (index) => {
                thumbnails.forEach(t => t.classList.remove('active'));
                thumbnails[index].classList.add('active');

                const newSrc = thumbnails[index].dataset.src;

                // Update main image
                mainImage.src = newSrc;

                // Update zoom anchor href
                if (zoomLink) {
                    zoomLink.href = newSrc;
                }

                thumbnails[index].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });

                currentIndex = index;
            };

            // Initial image set
            thumbnails.forEach((thumbnail, index) => {
                if (thumbnail.classList.contains('active')) {
                    currentIndex = index;
                }

                thumbnail.addEventListener('click', (e) => {
                    e.preventDefault();
                    updateMainImage(index);
                });
            });

            nextButton?.addEventListener('click', () => {
                const nextIndex = (currentIndex + 1) % thumbnails.length;
                updateMainImage(nextIndex);
            });

            prevButton?.addEventListener('click', () => {
                const prevIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
                updateMainImage(prevIndex);
            });
        }

        document.addEventListener('DOMContentLoaded', imagesInit);
        document.addEventListener('livewire:navigated', imagesInit);
    </script>
@endpush


@assets
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endassets

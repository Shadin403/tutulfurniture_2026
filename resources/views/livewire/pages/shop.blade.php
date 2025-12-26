@section('title', 'Shop')

<div>
    <main class="main">

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div x-data="{ open: false }" class="widget-category mb-4 shadow-sm rounded p-4">

                            <div class="shop-product-fillter">
                                <div class="totall-product">
                                    <p> Total <strong class="text-brand">{{ $products_count }}</strong> items in shop
                                    </p>
                                    <p> We found <strong class="text-brand">{{ count($products) }}</strong> items for
                                        you!
                                    </p>
                                </div>
                                <div class="sort-by-product-area" style="display: flex; gap: 2px; margin-right: 20px ;">
                                    <div wire:loading wire:target="perPageValueChange" style="margin-right: auto;"
                                        class="custom-dropdown">
                                        <img src="https://api.iconify.design/eos-icons:bubble-loading.svg"
                                            alt="{{ $parPageValue }}">
                                    </div>
                                    <!-- Show Dropdown -->
                                    <div wire:loading.remove wire:target="perPageValueChange" class="custom-dropdown">
                                        <div class="dropdown-toggle" onclick="toggleCustomDropdown(this)">
                                            <i class="fi-rs-apps"></i>
                                            Show: {{ $parPageValue }}
                                            {{-- <i class="fi-rs-angle-small-down"></i> --}}
                                        </div>
                                        <ul class="dropdown-options">
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="perPageValueChange(12)">
                                                12 @if ($parPageValue == 12)
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="perPageValueChange(24)">
                                                24 @if ($parPageValue == 24)
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="perPageValueChange(36)">
                                                36 @if ($parPageValue == 36)
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="perPageValueChange(50)">
                                                50 @if ($parPageValue == 50)
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>


                                    <div wire:loading wire:target="shortByValueChange" style="margin-right: auto;"
                                        class="custom-dropdown">
                                        <img src="https://api.iconify.design/eos-icons:bubble-loading.svg"
                                            alt="{{ $parPageValue }}">
                                    </div>
                                    <!-- Sort Dropdown -->
                                    <div wire:loading.remove wire:target="shortByValueChange" class="custom-dropdown">
                                        <div class="dropdown-toggle" onclick="toggleCustomDropdown(this)">
                                            <i class="fi-rs-apps"></i>
                                            Sort: {{ ucfirst(str_replace('_', ' ', $shortBy)) }}
                                            <i class="fi-rs-angle-small-down"></i>
                                        </div>
                                        <ul class="dropdown-options">
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="shortByValueChange('latest')">
                                                Latest Date @if ($shortBy == 'latest')
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="shortByValueChange('oldest')">
                                                Oldest Date @if ($shortBy == 'oldest')
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="shortByValueChange('featured')">
                                                Featured @if ($shortBy == 'featured')
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="shortByValueChange('price_low_to_high')">
                                                Price: Low to High @if ($shortBy == 'price_low_to_high')
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                            <li onclick="event.stopPropagation()"
                                                wire:click.prevent="shortByValueChange('price_high_to_low')">
                                                Price: High to Low @if ($shortBy == 'price_high_to_low')
                                                    <i class="fa-solid fa-check text-danger"></i>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            <div @click="open = !open"
                                style="display: flex; justify-content: space-between; cursor: pointer">
                                <h5 class="section-title fw-bold mb-3 border-bottom pb-2">Filters</h5>
                                <span> <i class="fi-rs-angle-small-down" style="font-size: 24px"></i></span>
                            </div>



                            <div x-show="open" x-cloak x-transition class="col-lg-12 primary-sidebar sticky-sidebar">
                                <div class="row">
                                    <div class="col-lg-12 col-mg-6"></div>
                                    <div class="col-lg-12 col-mg-6"></div>
                                </div>

                                {{-- !categories --}}
                                <div x-data="{ open: @entangle('openC') }" class="widget-category mb-4 shadow-sm rounded p-4">

                                    <div @click="open = !open"
                                        style="display: flex; justify-content: space-between; cursor: pointer">
                                        <h5 class="section-title fw-bold mb-3 border-bottom pb-2">Categories</h5>
                                        <span> <i class="fi-rs-angle-small-down" style="font-size: 24px"></i></span>
                                    </div>

                                    <ul wire:prevent-scroll x-show="open" x-cloak x-transition
                                        class="categories list-unstyled">
                                        @forelse($visibleCategories as $category)
                                            <li x-data="{ checked: false }" wire:key="category-{{ $category->id }}"
                                                class="category-item mb-2">
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center text-decoration-none text-dark hover-primary">
                                                    @if ($category->image)
                                                        <div class="category-img me-3"
                                                            @click.prevent="checked = !checked">
                                                            <img class="circle" width="40" height="40"
                                                                src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                                                                alt="{{ $category->name }}">
                                                        </div>
                                                    @endif
                                                    <div class="form-check">
                                                        <input wire:model.live='selectedCategories'
                                                            style="margin-top: 6px;cursor: pointer;"
                                                            class="form-check-input " type="checkbox" name="checkbox"
                                                            id="exampleCheckbox{{ $category->id }}"
                                                            value="{{ $category->id }}">
                                                        <label class="form-check-label" style="cursor: pointer;"
                                                            for="exampleCheckbox{{ $category->id }}">
                                                            <span>{{ $category->name }}
                                                                ({{ $category->product->count() }})
                                                            </span>
                                                        </label>
                                                    </div>

                                                </a>
                                            </li>

                                        @empty
                                            <li class="text-center text-muted py-3">
                                                <i class="fas fa-info-circle me-2"></i>No categories found!
                                            </li>
                                        @endforelse

                                        @if ($visibleCountC < $categories->count())
                                            <a class="" wire:click="loadMore">See More..</a>
                                        @else
                                            <a class="" wire:click="seeLess">See less </a>
                                        @endif

                                    </ul>
                                </div>
                                {{-- !sub-categories --}}
                                <div x-data="{ open: @entangle('openSC') }" class="widget-category mb-4 shadow-sm rounded p-4">

                                    <div @click="open = !open"
                                        style="display: flex; justify-content: space-between; cursor: pointer">
                                        <h5 class="section-title fw-bold mb-3 border-bottom pb-2">Sub Categories</h5>
                                        <span> <i class="fi-rs-angle-small-down" style="font-size: 24px"></i></span>
                                    </div>


                                    <ul x-show="open" x-cloak x-transition class="sub-categories class="categories
                                        list-unstyled">
                                        @forelse($visibleSubCategories as $category)
                                            <li x-data="{ checked: false }" wire:key="category-{{ $category->id }}"
                                                class="category-item mb-2">
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center text-decoration-none text-dark hover-primary">
                                                    @if ($category->image)
                                                        <div class="category-img me-3"
                                                            @click.prevent="checked = !checked">
                                                            <img class="circle" width="40" height="40"
                                                                src="{{ asset('storage/uploads/sub-categories/' . $category->image) }}"
                                                                alt="{{ $category->name }}">
                                                        </div>
                                                    @endif
                                                    <div class="form-check">
                                                        <input wire:model.live='selectedSubCategories'
                                                            style="margin-top: 6px;cursor: pointer;"
                                                            class="form-check-input " type="checkbox" name="checkbox"
                                                            id="exampleCheckbox{{ $category->id }}"
                                                            value="{{ $category->id }}">
                                                        <label style="cursor: pointer;" class="form-check-label"
                                                            for="exampleCheckbox{{ $category->id }}">
                                                            <span>{{ $category->name }}
                                                                ({{ $category->products->count() }})
                                                            </span>
                                                        </label>
                                                    </div>

                                                </a>
                                            </li>
                                        @empty
                                            <li class="text-center text-muted py-3">
                                                <i class="fas fa-info-circle me-2"></i>No categories found!
                                            </li>
                                        @endforelse

                                        @if ($visibleCountSC < $sub_categories->count())
                                            <a class="" wire:click="loadMoreSC">See More..</a>
                                        @else
                                            <a class="" wire:click="seeLessSC">See less </a>
                                        @endif
                                    </ul>
                                </div>

                                <!-- Fillter By Price -->
                                <div x-data="{ open: false }" class="sidebar-widget price_range range mb-30">


                                    <div @click="open = !open"
                                        style="display: flex; justify-content: space-between; cursor: pointer">
                                        <h5 class="section-title fw-bold mb-3 border-bottom pb-2">Filter By </h5>
                                        <span> <i class="fi-rs-angle-small-down" style="font-size: 24px"></i></span>
                                    </div>

                                    <div x-show="open" x-cloak x-transition>
                                        <div class="price-filter">
                                            <div class="price-filter-inner">
                                                <div id="slider-range"></div>
                                                <div class="price_slider_amount">
                                                    <div class="label-input" wire:ignore>
                                                        <span>Range:</span><input type="text" id="amount"
                                                            name="price" placeholder="Add Your Price">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group">
                                            <div class="list-group-item mb-10 mt-10">
                                                <label class="fw-900">Color</label>
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox1" value="">
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red
                                                            (56)</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox2" value="">
                                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green
                                                            (78)</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox3" value="">
                                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue
                                                            (54)</span></label>
                                                </div>
                                                <label class="fw-900 mt-15">Item Condition</label>
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox11" value="">
                                                    <label class="form-check-label" for="exampleCheckbox11"><span>New
                                                            (1506)</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox21" value="">
                                                    <label class="form-check-label"
                                                        for="exampleCheckbox21"><span>Refurbished
                                                            (27)</span></label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox31" value="">
                                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used
                                                            (45)</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="javascript:void(0)" class="btn btn-sm btn-default"><i
                                                class="fi-rs-filter mr-5"></i>
                                            Fillter</a>
                                    </div>
                                </div>


                            </div>


                        </div>


                        <div class="row product-grid-3">
                            @forelse($products as $product)
                                @if ($product->is_active == 1)
                                    @php
                                        $uniqueId = 'furnitureModal_' . $product->id;
                                    @endphp
                                    <div wire:preserve-scroll class="col-lg-4 col-md-4 col-6 col-sm-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="javascript:void(0)">
                                                        <img class="default-img"
                                                            src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                            alt="">

                                                        @php
                                                            $images = $product->gallery_images;
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
                                                    style="@if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0) opacity: 1 !important;  visibility: visible !important; @endif">
                                                    <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                                        wire:navigate aria-label="Quick view"
                                                        class="action-btn hover-up">
                                                        <i class="fi-rs-search"></i></a>
                                                    {{-- @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                                        <button aria-label="Remove To Wishlist" class="action-btn hover-up"
                                                         wire:loading.attr="disabled"
                                                            wire:click='removeFromWishlist("{{ Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId }}")'><i
                                                                class="fa-solid fa-heart fa-md"></i></button>
                                                    @else
                                                        <button aria-label="Add To Wishlist" class="action-btn hover-up"
                                                         wire:loading.attr="disabled"
                                                            wire:click='addToWishlist({{ $product->id }})'><i
                                                                class="fa-regular fa-heart fa-lg"></i></button>
                                                    @endif --}}
                                                    <a aria-label="Add To Wishlist"
                                                        class="action-btn hover-up wishlist-toggle"
                                                        data-id="{{ $product->id }}"
                                                        data-rowid="{{ Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId ?? null }}"
                                                        data-name="{{ $product->name }}"
                                                        data-slug="{{ $product->slug }}"
                                                        data-price="{{ $product->productDetail->discount_price ? $product->productDetail->discount_price : $product->productDetail->regular_price }}"
                                                        data-image="{{ $product->image }}">
                                                        @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                                            <i class="fa-solid fa-heart fa-lg"></i>
                                                        @else
                                                            <i class="fa-regular fa-heart fa-lg"></i>
                                                        @endif
                                                    </a>
                                                    {{-- <a aria-label="Compare" class="action-btn hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a> --}}
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    @if ($product->stock_status == 'instock')
                                                        <span class="new">Sale</span>
                                                    @elseif($product->stock_status == 'outofstock')
                                                        <span class="hot">Out of Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">

                                                    @if ($product->category)
                                                        <a href="javascript:void(0);"
                                                            wire:click.prevent='filterByCategory({{ $product->category->id }})'>{{ $product->category->name }}</a>
                                                    @endif
                                                    <br>
                                                    @if ($product->subCategory)
                                                        <a href="javascript:void(0);"
                                                            wire:click.prevent='filterBySubCategory({{ $product->subCategory->id }})'>{{ $product->subCategory->name }}</a>
                                                    @endif



                                                </div>
                                                <h2><a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                                        wire:navigate>{{ Str::limit($product->name, 20) }}</a>
                                                </h2>
                                                @php
                                                    $averageRating = round($product->reviews->avg('rating'));
                                                @endphp

                                                <div title="{{ $product->name }}" class="d-flex gap-1">
                                                    <div style="font-size: 10px;">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fa fa-star {{ $i <= $averageRating ? 'checked' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div style="font-size: 12px; margin-bottom: 5px;">
                                                        <span>{{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                                                            / 5</span>
                                                    </div>
                                                </div>

                                                <div class="product-price">
                                                    @if ($product->productDetail->discount_price)
                                                        <span>৳{{ $product->productDetail->discount_price }} </span>
                                                        <span
                                                            class="old-price">৳{{ $product->productDetail->regular_price }}</span>
                                                    @else
                                                        <span>৳{{ $product->productDetail->regular_price }}</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-1 show">
                                                    @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
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
                                                            class="action-btn hover-up addToCartButton"><i
                                                                class="fi-rs-shopping-bag-add"></i></button>
                                                    @endif
                                                </div>

                                                <div class="modal fade" id="{{ $uniqueId }}" tabindex="-1"
                                                    $ref="cartModal" aria-labelledby="furnitureModalLabel"
                                                    aria-hidden="false">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="furnitureModalLabel">Add
                                                                    to
                                                                    card
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <!-- Image Section -->
                                                                    <div class="col-md-6">
                                                                        <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                                            class="img-fluid modal-img"
                                                                            alt="Premium Sofa">
                                                                    </div>
                                                                    <!-- Details Section -->
                                                                    <div class="col-md-6">
                                                                        <span class="premium-badge">Premium
                                                                            Collection</span>
                                                                        @if ($product->productDetail->discount_price)
                                                                            <h4 class="mt-3">
                                                                                ${{ $product->productDetail->discount_price }}
                                                                            </h4>

                                                                            <s>${{ $product->productDetail->regular_price }}</s>
                                                                        @else
                                                                            <h4 class="mt-3">
                                                                                ${{ $product->productDetail->regular_price }}
                                                                            </h4>
                                                                        @endif
                                                                        <p class="text-muted">
                                                                            @if ($product->productDetail->short_description)
                                                                                {!! $product->productDetail->short_description !!}
                                                                            @else
                                                                                N/A
                                                                            @endif

                                                                        </p>
                                                                        <ul class="list-unstyled">
                                                                            <li><strong>Material:</strong>
                                                                                {{ $product->productDetail->material }}
                                                                            </li>


                                                                            {{-- <li><strong>Features:</strong> Magnetic
                                                                                Connectors, Memory Foam Cushions</li>
                                                                            <li><strong>Colors:</strong> Midnight Blue,
                                                                                Charcoal Gray, Ivory Cream</li> --}}
                                                                        </ul>
                                                                        {{-- <button data-bs-dismiss="modal"
                                                                            class="btn btn-primary w-100 AddToCart"
                                                                            data-id="{{ $product->id }}"
                                                                            data-name="{{ $product->name }}"
                                                                            data-slug="{{ $product->slug }}"
                                                                            data-price="{{ $product->productDetail->discount_price ?? $product->productDetail->regular_price }}"
                                                                            data-image="{{ $product->image }}"
                                                                            aria-label="">Add
                                                                            to
                                                                            Cart</button> --}}
                                                                        <button data-bs-dismiss="modal"
                                                                            class="btn btn-primary w-100 AddToCart"
                                                                            wire:click='addToCart({{ $product->id }})'>Add
                                                                            to
                                                                            Cart</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-success">Learn
                                                                    More</button>
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
                                    <div class="alert alert-warning" role="alert">
                                        No products found!
                                    </div>
                                </div>
                            @endforelse


                        </div>
                        <!--pagination-->
                        {{ $products->links('livewire::bootstrap') }}
                        <!--pagination-->
                    </div>

                </div>
            </div>
        </section>











    </main>

</div>

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
                        '<i class="fa-solid fa-heart fa-lg"></i>';

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

        document.addEventListener("livewire:initialized", () => {
            Livewire.hook("element.init", ({
                el,
                component
            }) => {
                initWishlistToggle();
            });
        });
    </script>
    {{-- <script>
        // CSRF Token সেট করা
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content');

        // Add to cart ইভেন্ট যুক্ত করা
        function initAddToCart() {
            document.querySelectorAll('.AddToCart').forEach(function(btn) {
                // prevent duplicate bindings by cloning
                let newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);

                newBtn.addEventListener('click', handleCartClick);
            });
        }

        // Add to cart হ্যান্ডলার ফাংশন
        function handleCartClick(e) {
            e.preventDefault();

            let btn = e.currentTarget;

            let id = btn.getAttribute('data-id');
            let name = btn.getAttribute('data-name');
            let slug = btn.getAttribute('data-slug');
            let price = btn.getAttribute('data-price');
            let image = btn.getAttribute('data-image');

            let url = `add-to-cart/${id}`;
            let payload = {
                id: id,
                name: name,
                slug: slug,
                price: price,
                image: image
            };

            axios.post(url, payload)
                .then(function(response) {
                    Livewire.dispatch('alert-success', response.data.message || 'Cart updated.');
                    document.getElementById('cart-count').textContent = response.data.cartCount;

                    // বাটন পরিবর্তন করে লিংক বানানো
                    let newLink = document.createElement('a');
                    newLink.setAttribute('href', '/cart');
                    newLink.setAttribute('wire:navigate', '');
                    newLink.innerHTML = `
                    <button aria-label="go to cart" class="btn btn-primary w-100">
                        <i class="fa-solid fa-check"></i>
                    </button>
                `;

                    btn.replaceWith(newLink);
                })
                .catch(function(error) {
                    console.error('Cart Error:', error);
                });
        }

        // প্রথমবার লোড হওয়ার সময়
        document.addEventListener('DOMContentLoaded', initAddToCart);

        // Livewire SPA ন্যাভিগেশনের পরেও ইভেন্ট যুক্ত করা
        Livewire.hook('commit', () => {
            initAddToCart();
        });
    </script> --}}

    <script>
        function toggleCustomDropdown(element) {
            const dropdown = element.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.dropdown-options');

            allDropdowns.forEach(d => {
                if (d !== dropdown) d.style.display = 'none';
            });

            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Hide all dropdowns when clicking outside
        document.addEventListener("click", function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.dropdown-options').forEach(d => {
                    d.style.display = 'none';
                });
            }
        });
    </script>
@endpush



@push('styles')
    <style>
        .fa-star.checked {
            color: orange;
        }

        body {
            overflow-x: hidden !important;
        }

        .custom-dropdown {
            position: relative;
            display: inline-block;
            font-family: sans-serif;
        }

        .dropdown-toggle {
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 6px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 160px;
            justify-content: center;
            font-size: 14px;
        }

        .dropdown-toggle:hover {
            background-color: #f1f1f1;
        }

        .dropdown-options {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 99;
            min-width: 180px;
            list-style: none;
            margin: 0;
            padding: 5px 0;
        }

        .dropdown-options li {
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-options li:hover {
            background-color: #f5f5f5;
            font-weight: bold;
        }
    </style>
@endpush

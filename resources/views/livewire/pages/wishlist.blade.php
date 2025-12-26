@section('title', 'Wishlist')

<div>
    <main class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-5 fw-bold mb-0">My Wishlist</h1>
                <p class="text-muted">Keep track of items you love</p>
            </div>
        </div>



        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <div class="shop-product-fillter">

                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-auto">
                        <div class="input-group">
                            <input wire:model.live.debounce.500ms="search" type="text"
                                class="form-control form-control-sm" id="searchInput" placeholder="Search wishlist...">
                            <button class="btn btn-sm btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wishlist Stats -->
        <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Items</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-5 fw-bold me-2">{{ Cart::instance('wishlist')->count() }}</span>
                            {{-- <span class="badge bg-success">+2 this week</span> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Price Drops</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-5 fw-bold me-2"> </span>
                            <span class="badge bg-danger">-15% avg</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Wishlist Total</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-5 fw-bold me-2">${{ Cart::instance('wishlist')->total() }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div wire:loading wire:target="search">
            <div style="display: flex; justify-content: center; align-items: center; height: 200px;">
                <img src="https://api.iconify.design/svg-spinners:270-ring-with-bg.svg" alt="loading">
            </div>

        </div>


        <!-- Wishlist Items -->
        <div wire:loading.remove wire:target="search" class="row" id="wishlistContainer">
            <div class="loader" id="loader">
                <div class="spinner"></div>
            </div>
            <!-- Item 1 -->
            @forelse($wishlists as $index => $wishlist)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4" style="cursor: pointer">
                    <div class="card h-100 wishlist-card border-0 shadow-sm">
                        @if ($wishlist->model->stock_status == 'outofstock')
                            <span class="badge bg-danger wishlist-badge">Out Of Stock</span>
                        @else
                            <span class="badge bg-success wishlist-badge">In Stock</span>
                        @endif

                        <img src="{{ asset('storage/uploads/products/' . $wishlist->model->image) }}"
                            class="card-img-top" alt="Premium Headphones">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $wishlist->name }}</h5>
                                <button class="btn btn-sm btn-wishlist btn-light"
                                    wire:click="removeFromWishlist('{{ Cart::instance('wishlist')->content()->where('id', $wishlist->id)->first()->rowId }}')"
                                    title="Remove from wishlist">
                                    <i class="fi-rs-heart"></i>
                                </button>
                            </div>
                            <p class="card-text small text-muted mb-2">{{ $wishlist->model->category->name }}</p>
                            <p class="card-text small text-muted mb-2">{{ $wishlist->model->subCategory->name }}</p>
                            <div class="d-flex align-items-center mb-3">
                                @if ($wishlist->model->productDetail->discount_price)
                                    <span
                                        class="fw-bold me-2">${{ $wishlist->model->productDetail->discount_price }}</span>
                                    <span
                                        class="text-muted text-decoration-line-through">${{ $wishlist->model->productDetail->regular_price }}</span>
                                @else
                                    <span
                                        class="fw-bold me-2">${{ $wishlist->model->productDetail->regular_price }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end  align-items-center">
                                {{-- <span class="badge bg-success"></span> --}}
                                @if ($wishlist->model->stock_status == 'outofstock')
                                    <button style="background: red; border: none;" class="btn btn-sm">Out of
                                        Stock</button>
                                @else
                                    <button wire:loading
                                        wire:target="moveToCart('{{ Cart::instance('wishlist')->content()->where('id', $wishlist->id)->first()->rowId }}')"
                                        wire:click='moveToCart("{{ Cart::instance('wishlist')->content()->where('id', $wishlist->id)->first()->rowId }}")'
                                        class="btn btn-sm btn-primary">Moving to Cart <img
                                            src="https://api.iconify.design/svg-spinners:270-ring-with-bg.svg"
                                            alt="loading"> </button>
                                    <button wire:loading.remove
                                        wire:target="moveToCart('{{ Cart::instance('wishlist')->content()->where('id', $wishlist->id)->first()->rowId }}')"
                                        wire:click='moveToCart("{{ Cart::instance('wishlist')->content()->where('id', $wishlist->id)->first()->rowId }}")'
                                        class="btn btn-sm btn-primary">Move to Cart</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty

                <h1>Wishlist is empty</h1>
            @endforelse



        </div>

        <!-- Empty Wishlist State (hidden by default) -->
        <div class="row d-none" id="emptyWishlist">
            <div class="col-12 text-center empty-wishlist">
                <img src="/api/placeholder/200/200" alt="Empty Wishlist" class="mb-4">
                <h3>Your wishlist is empty</h3>
                <p class="text-muted mb-4">Start adding items you love to your wishlist</p>
                <button class="btn btn-primary">Explore Products</button>
            </div>
        </div>

        <!-- Bulk Actions -->
        @if (!$wishlists->isEmpty())
            <div class="row mt-4">
                <div class="col-12 ">
                    <div class="d-flex justify-content-end align-items-center ">
                        <button wire:click="removeAllWishlist" type="button"
                            style="background-color: #dc3545 !important;"
                            class="btn btn-link text-white float-right">Clear All</button>
                    </div>
                </div>
            </div>
        @endif

    </main>
</div>




@push('styles')
    <style>
        .wishlist-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .wishlist-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .price-tag {
            font-weight: 600;
            color: #495057;
        }

        .sale-price {
            color: #dc3545;
        }

        .original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-wishlist {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
        }

        .filter-btn.active {
            background-color: #6c5ce7;
            color: white;
        }

        .empty-wishlist {
            padding: 60px 0;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;

        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3eeee;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Success toast */
        .colored-toast.swal2-icon-success {
            background-color: #28a745 !important;
        }

        /* Error toast */
        .colored-toast.swal2-icon-error {
            background-color: #dc3545 !important;
        }

        /* Warning toast */
        .colored-toast.swal2-icon-warning {
            background-color: #ffc107 !important;
        }

        /* Info toast */
        .colored-toast.swal2-icon-info {
            background-color: #17a2b8 !important;
        }

        /* Question toast */
        .colored-toast.swal2-icon-question {
            background-color: #6c757d !important;
        }

        /* Customize text color */
        .colored-toast .swal2-title {
            color: white !important;
        }
    </style>
@endpush



@push('scripts')
    <!-- Add Toastify.js CDN link to your HTML -->


    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        // Function to show all toasts
        async function showToasts() {
            await Toast.fire({
                icon: 'success',
                title: 'Success',
            });
            await Toast.fire({
                icon: 'error',
                title: 'Error',
            });
            await Toast.fire({
                icon: 'warning',
                title: 'Warning',
            });
            await Toast.fire({
                icon: 'info',
                title: 'Info',
            });
            await Toast.fire({
                icon: 'question',
                title: 'Question',
            });
        }



        document.addEventListener('wishlist-added', function() {

            // Show Loader
            document.getElementById("loader").style.display = "flex";
            console.log("hello");

            setTimeout(function() {
                // Hide Loader
                document.getElementById("loader").style.display = "none";
            }, 500);

            // Show Toast
            Toast.fire({
                icon: 'success',
                title: 'Success',
                position: "top-end",
            });

        });
    </script>
@endpush

@section('title', 'Cart')

<div>
    {{-- @dump($districts) --}}
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" wire:navigate rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">No:</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cartItems as $item)
                                        <tr wire:loading wire:target="removeItem,removeAllCart"
                                            wire:key='{{ $item->rowId }}'>
                                            <td colspan="7">
                                                <div class="d-flex justify-content-center align-items-center"
                                                    style="min-height: 100px;">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr wire:loading.remove wire:target="removeItem" wire:key='{{ $item->rowId }}'>

                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('storage/uploads/products/' . $item->options['image']) }}"
                                                    alt="#"></td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a wire:navigate class="text-info "
                                                        href="{{ route('product.details', ['slug' => $item->options['slug']]) }}">{{ $item->name }}</a>
                                                </h5>

                                            </td>
                                            <td class="price" data-title="Price">

                                                @if ($item->model->productDetail->discount_price)
                                                    <s
                                                        class="text-muted">${{ $item->model->productDetail->regular_price }}</s>
                                                    <span
                                                        class="text-danger">${{ $item->model->productDetail->discount_price }}</span>
                                                @else
                                                    <span class="text-danger">${{ $item->price }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="quantity-selector d-flex align-items-center gap-2">

                                                    <!-- Minus Button -->
                                                    <div class="position-relative d-flex align-items-center">
                                                        <button class="quantity-btn" wire:loading.remove
                                                            wire:click="decrement('{{ $item->rowId }}')"
                                                            wire:loading.attr="disabled"
                                                            wire:target="decrement('{{ $item->rowId }}')">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                        <!-- Loader for Minus -->
                                                        <span wire:loading
                                                            wire:target="decrement('{{ $item->rowId }}')"
                                                            class="spinner-border spinner-border-sm text-secondary ms-1"
                                                            role="status" aria-hidden="true">
                                                        </span>
                                                    </div>

                                                    <!-- Quantity Display -->
                                                    <span class="quantity-value">{{ $item->qty }}</span>

                                                    <!-- Plus Button -->
                                                    <div class="position-relative d-flex align-items-center">
                                                        <button class="quantity-btn" wire:loading.remove
                                                            wire:click="increment('{{ $item->rowId }}')"
                                                            wire:loading.attr="disabled"
                                                            wire:target="increment('{{ $item->rowId }}')">
                                                            <i class="fas fa-plus"></i>
                                                        </button>

                                                        <!-- Loader for Plus -->
                                                        <span wire:loading
                                                            wire:target="increment('{{ $item->rowId }}')"
                                                            class="spinner-border spinner-border-sm text-secondary ms-1"
                                                            role="status" aria-hidden="true">
                                                        </span>
                                                    </div>

                                                </div>
                                            </td>


                                            <td class="text-right" data-title="Cart">
                                                <div wire:loading
                                                    wire:target="increment('{{ $item->rowId }}'), decrement('{{ $item->rowId }}')">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <span wire:loading.remove
                                                    wire:target="increment('{{ $item->rowId }}'), decrement('{{ $item->rowId }}')">${{ $item->price * $item->qty }}</span>
                                            </td>
                                            <td class="action" data-title="Remove">
                                                <a wire:click="removeItem('{{ $item->rowId }}')" class="text-muted"><i
                                                        class="fi-rs-trash"></i></a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Cart is empty</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            @if ($cartItems->count() > 0)
                                <a role="button" wire:click="removeAllCart" class="btn  mr-10 mb-sm-15"
                                    style="background: #DC3545; border: none;"><i class="fi-rs-trash mr-10"></i>Empty
                                    Cart</a>
                            @endif
                            <a role="button" class="btn mb-sm-15" href="{{ route('shop') }}"
                                style="background: #17ABD1; border: none;"><i
                                    class="fi-rs-shopping-bag mr-10"></i>Continue
                                Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">

                            {{-- ? Address section  --}}


                            <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">
                                    <h4>Calculate Shipping</h4>
                                </div>
                                <p class="mt-15 mb-30">Flat rate: <span
                                        class="font-xl text-brand fw-900">{{ Cart::instance('cart')->tax() }}%</span>
                                </p>
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive" style="overflow-x: scroll !important;">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{ Cart::instance('cart')->subtotal() }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free
                                                        Shipping</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span
                                                                class="font-xl fw-900 text-brand">${{ Cart::instance('cart')->total() }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @auth
                                        <a href="{{ route('checkout') }}" wire:navigate class="btn "> <i
                                                class="fi-rs-box-alt mr-10"></i>
                                            Proceed To CheckOut</a>
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" wire:navigate class="btn "> <i
                                                class="fi-rs-box-alt mr-10"></i>
                                            Login First</a>
                                    @endguest


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

        .switch {
            position: relative;
            display: inline-block;
            width: 42px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #33b85f;
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }

        @media (max-width: 576px) {
            .dropdown-menu {
                width: 100% !important;
                left: 0 !important;
                right: 0 !important;
                margin: 0 auto;
                border-radius: 0.5rem;
                overflow-x: auto;
            }
        }
    </style>
@endpush


@push('scripts')
    <script>
        function increment(rowId) {
            window.Livewire.dispatch('increment', {
                rowId
            });
            console.log(rowId);
        }

        function decrement(rowId) {

            window.Livewire.dispatch('increment', {
                rowId
            });
            console.log(rowId);
        }
    </script>
@endpush

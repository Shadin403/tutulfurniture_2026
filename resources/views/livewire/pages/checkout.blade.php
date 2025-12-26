@section('title', 'Checkout')

<div>

    <main class="main">



        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">

            <div class="container">
                {{-- <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an
                                    account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed"
                                    aria-expanded="false">Click here to login</a></span>
                        </div>
                        <div class="panel-collapse collapse login_form" id="loginform">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details
                                    below. If you are a new customer, please proceed to the Billing &amp; Shipping
                                    section.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Username Or Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" name="login">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a
                                    href="#coupon" data-bs-toggle="collapse" class="collapsed"
                                    aria-expanded="false">Click here to enter your code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Coupon Code...">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn  btn-md" name="login">Apply Coupon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <h1>Checkout</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        @auth
                            @if ($addresses->count() > 0)
                                <h4 class="text-brand">Shipping Address <span class="required">*</span></h4>
                                <hr>
                                @foreach ($addresses as $address)
                                    @php
                                        $address->country = 'বাংলাদেশ';
                                    @endphp
                                    <div wire:loading wire:target="setDefaultAddress">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div wire:loading.remove wire:target="setDefaultAddress" class="form-group">
                                        <div class="card mb-2 shadow-sm border border-success">
                                            <div class="card-body d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1 text-primary">
                                                        <i class="bi bi-person-fill me-1"></i>
                                                        {{ $address->name }}
                                                    </h6>
                                                    <p class="mb-1 text-muted small">
                                                        <i class="bi bi-telephone-fill me-1"></i>
                                                        {{ $address->phone }}
                                                    </p>
                                                    <p class="mb-1 small text-muted">
                                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                                        {{ $address->address }}, {{ $address->upazila }},
                                                        {{ $address->district }}, {{ $address->division }},
                                                        {{ $address->postal_code }},
                                                        {{ $address->country }}
                                                    </p>
                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                @endforeach

                                {{-- ?  Address Modal --}}
                                <div class="form-group">
                                    <!-- Address Dropdown and Add Button -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div x-data="{ open: false }" class="position-relative">
                                            <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button"
                                                id="addressDropdown" @click="open = !open">
                                                Select Shipping Address
                                            </button>

                                            <!-- Dropdown list -->
                                            <ul x-show="open" @click.away="open = false" x-transition
                                                class="dropdown-menu show p-2 mt-1 shadow"
                                                style="display: block; width: 700px; max-width: 700px; max-height: 300px; overflow-y: auto; overflow-x: auto; z-index: 1000;"
                                                aria-labelledby="addressDropdown">

                                                {{-- ? all addresses --}}
                                                @if ($allAddresses->count() > 0)
                                                    @foreach ($allAddresses as $address)
                                                        @php
                                                            $address->country = 'বাংলাদেশ';
                                                        @endphp
                                                        <li
                                                            class="dropdown-item d-flex justify-content-between align-items-center flex-wrap border rounded mb-2 p-2">
                                                            <div class="w-75">
                                                                <strong>{{ $address->name }}</strong><br>
                                                                {{ $address->address }}, {{ $address->upazila }},
                                                                {{ $address->district }},
                                                                {{ $address->division }},
                                                                {{ $address->postal_code }},
                                                                {{ $address->country }}
                                                            </div>

                                                            <!-- Custom Switch -->
                                                            <label class="switch m-0">
                                                                <input type="radio" name="default_address"
                                                                    @if ($address->is_default == 1) checked @endif
                                                                    wire:click="setDefaultAddress({{ $address->id }})">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="dropdown-item">No addresses found.</li>
                                                @endif
                                            </ul>
                                        </div>


                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#newAddressAdd">
                                            <i class="fi-rs-plus"></i> Add New Address
                                        </button>
                                    </div>

                                    {{-- ? Add New Address Modal  --}}
                                    <div class="modal fade" id="newAddressAdd" tabindex="-1" wire:ignore.self
                                        aria-labelledby="AddressModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Shipping Address</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form wire:submit.prevent="addressSave"
                                                        class="field_form shipping_calculator">
                                                        <h4 class="text-brand">Basic Information <span
                                                                class="required">*</span></h4>
                                                        <hr>
                                                        <div class="form-row row">
                                                            <!-- Full Name -->
                                                            <div class="form-group col-lg-6">
                                                                <label for="name">Full Name</label>
                                                                <input id="name" type="text" class="form-control"
                                                                    placeholder="Enter your full name"
                                                                    wire:model.defer="name">
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Phone -->
                                                            <div class="form-group col-lg-6">
                                                                <label for="phone">Phone</label>
                                                                <input id="phone" type="text" class="form-control"
                                                                    placeholder="Enter your phone number"
                                                                    wire:model="phone">
                                                                @error('phone')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Shipping Address Info -->
                                                        <h4 class="text-brand mt-4">Shipping Address <span
                                                                class="required">*</span></h4>
                                                        <hr>
                                                        <div class="form-row row">
                                                            <!-- Division -->
                                                            <div class="form-group col-lg-6">
                                                                <label>Division (বিভাগ) <span
                                                                        class="text-danger">*</span></label>
                                                                <select wire:model.live="division_id" class="form-control">
                                                                    <option value="">Choose an option...
                                                                    </option>
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->id }}">
                                                                            {{ $division->bn_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- District -->
                                                            <div class="form-group col-lg-6">
                                                                <label>District (জেলা) <span
                                                                        class="text-danger">*</span></label>
                                                                <select wire:model.live="district_id" class="form-control"
                                                                    @if (empty($division_id)) disabled @endif>
                                                                    <option value="">Choose an option...
                                                                    </option>
                                                                    @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}">
                                                                            {{ $district->bn_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('district_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Upazila -->
                                                            <div class="form-group col-lg-6">
                                                                <label>Upazila (উপজেলা) <span
                                                                        class="text-danger">*</span></label>
                                                                <select wire:model="upazila_id" class="form-control"
                                                                    @if (empty($district_id)) disabled @endif>
                                                                    <option value="">Choose an option...
                                                                    </option>
                                                                    @foreach ($upazilas as $upazila)
                                                                        <option value="{{ $upazila->id }}">
                                                                            {{ $upazila->bn_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('upazila_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Post Code -->
                                                            <div class="form-group col-lg-6">
                                                                <label>Post Code (পোস্ট কোড) <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter your post code"
                                                                    wire:model.defer="postal_code">
                                                                @error('postal_code')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Area (Optional) -->
                                                            <div class="form-group col-lg-6">
                                                                <label>Area (এরিয়া) <span
                                                                        class="text-info">(optional)</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter your area"
                                                                    wire:model.defer="locality">
                                                                @error('locality')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Full Address -->
                                                            <div class="form-group col-lg-12">
                                                                <label>Full Address (সম্পূর্ণ ঠিকানা) <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter your full address"
                                                                    wire:model.defer="address">
                                                                @error('address')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <!-- Set as Default -->
                                                            {{-- <div class="form-check mt-2">
                                                                <input type="checkbox" wire:model="is_default"
                                                                    id="switchCheckDefault">
                                                                <label class="form-check-label" for="switchCheckDefault">
                                                                    Set as Default Address?
                                                                </label>
                                                            </div> --}}

                                                            <div class="tooltip-wrapper">
                                                                <label class="switch">
                                                                    <input type="checkbox" wire:model.live="is_default"
                                                                        name="default_address">
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <span
                                                                    class="tooltiptext">{{ $is_default ? 'Set as Default Address' : 'Make Default Address' }}</span>
                                                            </div>
                                                        </div>

                                                        <!-- Submit Button -->
                                                        <div class="form-row mt-3">
                                                            <div class="form-group col-lg-12">
                                                                <button type="submit" class="btn btn-brand btn-sm">
                                                                    <i class="fi-rs-shuffle mr-10"></i>Save Address
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- ? Address Create Form --}}
                                <form wire:submit.prevent="addressSave" class="field_form shipping_calculator">
                                    <h4 class="text-brand">Basic Information <span class="required">*</span></h4>
                                    <hr>

                                    <div class="form-row row">

                                        <div class="form-group col-lg-6">
                                            <label for="name">Full Name</label>
                                            <input id="name" type="text" class="form-control"
                                                placeholder="Enter your full name" wire:model.defer="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-lg-6">
                                            <label for="phone">Phone</label>
                                            <input id="phone" type="text" class="form-control"
                                                placeholder="Enter your phone number" wire:model="phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="text-brand mt-4">Shipping Address <span class="required">*</span>
                                    </h4>
                                    <hr>

                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <label for="division">Division (বিভাগ) <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom_select">
                                                <select wire:model.live="division_id" class="form-control">
                                                    <option value="">Choose a option...</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">
                                                            {{ $division->bn_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="district">District (জেলা) <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom_select">
                                                <select wire:model.live="district_id" class="form-control"
                                                    @if (empty($division_id)) disabled @endif>
                                                    <option value="">Choose a option...</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}">
                                                            {{ $district->bn_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="upazila">Upazila (উপজেলা) <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom_select">
                                                <select wire:model="upazila_id" class="form-control"
                                                    @if (empty($district_id)) disabled @endif>
                                                    <option value="">Choose a option...</option>
                                                    @foreach ($upazilas as $upazila)
                                                        <option value="{{ $upazila->id }}">
                                                            {{ $upazila->bn_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('upazila_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="postcode">Post Code (পোস্ট কোড) <span
                                                    class="text-danger">*</span></label>
                                            <input id="postcode" type="text" class="form-control"
                                                placeholder="Enter your post code" wire:model.defer="postal_code">
                                            @error('postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="postcode">Area (এরিয়া) <span
                                                    class="text-info">(optional)</span></label>
                                            <input id="locality" type="text" class="form-control"
                                                placeholder="Enter your area" wire:model.defer="locality">
                                            @error('locality')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="address">Full Address (সম্পূর্ণ ঠিকানা) <span
                                                    class="text-danger">*</span></label>
                                            <input id="address" type="text" class="form-control"
                                                placeholder="Enter your full address" wire:model.defer="address">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-flex gap-1 py-2">
                                            <input type="checkbox" class="custom-toggle" wire:model.live="is_default"
                                                required>
                                            {{ $is_default ? 'Default Address' : 'Make Default Address' }}
                                        </div>
                                    </div>

                                    <div class="form-row mt-5">
                                        <div class="form-group col-lg-12">
                                            <button type="submit" class="btn btn-brand btn-sm">
                                                <i class="fi-rs-shuffle mr-10"></i>Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        @endauth

                        @guest
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <a href="{{ route('login') }}" class="btn btn-brand btn-sm">
                                        <i class="fi-rs-shuffle mr-10"></i>Login First
                                    </a>
                                </div>
                            </div>
                        @endguest


                        {{-- <div class="mb-30 mt-50">
                            <div class="heading_s1 mb-3">
                                <h4>Apply Coupon</h4>
                            </div>
                            <div class="total-amount">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <div class="form-row row justify-content-center">
                                                <div class="form-group col-lg-6">
                                                    <input class="font-medium"
                                                        placeholder="Enter Your Coupon">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <button class="btn  btn-sm"><i
                                                            class="fi-rs-label mr-10"></i>Apply</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-6">
                        @if (Session::has('success'))
                            <div class="border-4 shadow-sm alert alert-success alert-dismissible fade show border-start border-success"
                                role="alert">
                                <i class="bi bi-check-circle me-2"></i> {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="border-4 shadow-sm alert alert-danger alert-dismissible fade show border-start border-danger"
                                role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i> {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cartItems as $index => $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ asset('storage/uploads/products/' . $item->options['image']) }}"
                                                        alt="{{ $item->name }}"></td>
                                                <td>
                                                    <h5><a wire:navigate
                                                            href="{{ route('product.details', ['slug' => $item->options['slug']]) }}">{{ $item->name }}</a>
                                                    </h5>
                                                    <span class="product-qty">{{ $item->price }}x
                                                        {{ $item->qty }}</span>
                                                </td>
                                                <td>
                                                    <div class="product-subtotal">${{ $item->price * $item->qty }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Cart is empty</td>
                                            </tr>
                                        @endforelse


                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">
                                                ${{ Cart::instance('cart')->subtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span
                                                    class="font-xl text-brand fw-900">${{ Cart::instance('cart')->total() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" wire:click="paymentOption('cod')"
                                            type="radio" name="payment_option" id="exampleRadios3">
                                        <label class="form-check-label" for="exampleRadios3"
                                            data-bs-toggle="collapse" data-target="#cashOnDelivery"
                                            aria-controls="cashOnDelivery">Cash On Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" wire:click="paymentOption('nagad')"
                                            type="radio" name="payment_option" id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4"
                                            data-bs-toggle="collapse" data-target="#cardPayment"
                                            aria-controls="cardPayment">Nagad</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" wire:click="paymentOption('bkash')"
                                            type="radio" name="payment_option" id="exampleRadios5">
                                        <label class="form-check-label" for="exampleRadios5"
                                            data-bs-toggle="collapse" data-target="#paypal"
                                            aria-controls="paypal">Bkash</label>
                                    </div>
                                </div>
                            </div>
                            <form wire:submit.prevent="save">
                                <button type="submit" class="btn btn-fill-out btn-block mt-30">Place
                                    Order</>
                            </form>
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

        .tooltip-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin: 10px 0;
        }

        .tooltip-wrapper .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 6px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Tooltip above */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip-wrapper .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            /* Arrow */
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .tooltip-wrapper:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Custom Switch */
        .switch {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: relative;
            display: inline-block;
            width: 46px;
            height: 24px;
            background-color: #ccc;
            border-radius: 24px;
            transition: 0.4s;
        }

        .slider::before {
            content: "";
            position: absolute;
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        input:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider::before {
            transform: translateX(22px);
        }

        .custom-toggle {
            appearance: none;
            -webkit-appearance: none;
            width: 50px;
            height: 26px;
            background-color: #ccc;
            border-radius: 15px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .custom-toggle::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #fff;
            top: 3px;
            left: 3px;
            transition: transform 0.3s;
        }

        .custom-toggle:checked {
            background-color: #28a745;
        }

        .custom-toggle:checked::before {
            transform: translateX(24px);
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


@assets
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endassets

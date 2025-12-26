<!-- Sidebar -->
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar vh-100 position-fixed" id="sidebar">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-4 min-vh-100">
        <!-- User Profile -->
        <div class="d-flex align-items-center mb-4 w-100">
            <div class="bg-primary text-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow"
                style="width: 48px; height: 48px;">
                <span class="fs-5 fw-bold">
                    {{ Str::upper(collect(explode(' ', auth()->user()->name))->map(fn($n) => Str::substr($n, 0, 1))->take(2)->implode('')) }}
                </span>
            </div>
            <div class="ms-3 user-info">
                <h3 class="fw-semibold text-white mb-0">{{ auth()->user()->name }}</h3>
                <p class="fw-semibold text-info mb-0">{{ auth()->user()->role }}</p>
            </div>
        </div>

        <!-- Navigation -->
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100">
            <li class="nav-item w-100">
                <a href="{{ route('customer.dashboard.overview') }}" wire:navigate> <button
                        class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 ">
                        <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="nav-text">Overview</span>
                    </button>
                </a>
            </li>
            <li class="nav-item w-100">
                <a href="{{ route('customer.dashboard.orders') }}" wire:navigate>
                    <button class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 ">
                        <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="nav-text">Orders</span>
                    </button>
                </a>
            </li>
            <li class="nav-item w-100">
                <a href="{{ route('customer.dashboard.profile') }}" wire:navigate>
                    <button class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 ">
                        <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="nav-text">Profile</span>
                    </button>
                </a>
            </li>
            <li class="nav-item w-100">
                <a href="{{ route('customer.dashboard.addresses') }}" wire:navigate>
                    <button class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 ">
                        <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="nav-text">Addresses</span>
                    </button>
                </a>
            </li>
        </ul>
    </div>
</div>

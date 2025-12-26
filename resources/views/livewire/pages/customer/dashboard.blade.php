@section('title', 'Dashboard')

<div class="container-fluid">
    <div class="row flex-nowrap">
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
                        <button wire:click="setActiveTab('overview')"
                            class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 {{ $activeTab === 'overview' ? 'active' : '' }}">
                            <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <span class="nav-text">Overview</span>
                        </button>
                    </li>
                    <li class="nav-item w-100">
                        <button wire:click="setActiveTab('orders')"
                            class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 {{ $activeTab === 'orders' ? 'active' : '' }}">
                            <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="nav-text">Orders</span>
                        </button>
                    </li>
                    <li class="nav-item w-100">
                        <button wire:click="setActiveTab('profile')"
                            class="nav-link d-flex align-items-center px-3 py-3 mb-2 rounded w-100 {{ $activeTab === 'profile' ? 'active' : '' }}">
                            <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="nav-text">Profile</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col py-3 main-content" style="margin-left: 250px;">
            <!-- Toggle Button for Mobile -->
            <button class="btn btn-primary mb-3 d-md-none" type="button" onclick="toggleSidebar()">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-semibold mb-0">Dashboard</h2>
                <a href="{{ route('home') }}" class="btn btn-success">
                    <svg class="me-1" width="16" height="16" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back Home
                </a>
            </div>

            <!-- Overview Tab -->
            @if ($activeTab === 'overview')
                <div class="row g-4 mb-4">
                    <!-- Stats Cards -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Orders</h6>
                                        <h4 class="mb-0">{{ $orders->total() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Completed Orders</h6>
                                        <h4 class="mb-0">{{ $orders->where('status', 'completed')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Wishlist Items</h6>
                                        <h4 class="mb-0">{{ Cart::instance('wishlist')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Spent</h6>
                                        <h4 class="mb-0">৳{{ number_format($orders->sum('total'), 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Recent Orders</h3>
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <table class="table table-hover align-middle" style="min-width: 600px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentOrders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>৳{{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Orders Tab -->
            @if ($activeTab === 'orders')
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 fw-bold mb-4">Order History</h3>
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <table class="table table-hover align-middle" style="min-width: 600px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>{{ $order->orderItems->count() }} items</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>৳{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-link text-primary">View Details</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Tab -->
            @if ($activeTab === 'profile')
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if ($success_message)
                            <div class="alert alert-success mb-4">
                                {{ $success_message }}
                            </div>
                        @endif

                        <h3 class="h5 fw-bold mb-4">Profile Settings</h3>
                        <form wire:submit.prevent="updateProfile">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" wire:model="name" class="form-control">
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" wire:model="email" class="form-control">
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" wire:model="mobile" class="form-control">
                                    @error('mobile')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="updateProfile"
                                            class="spinner-border spinner-border-sm me-1"></span>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">

                        <h4 class="h5 fw-bold mb-4">Change Password</h4>
                        <form wire:submit.prevent="updatePassword">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" wire:model="current_password" class="form-control">
                                    @error('current_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" wire:model="new_password" class="form-control">
                                    @error('new_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="updatePassword"
                                            class="spinner-border spinner-border-sm me-1"></span>
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background: linear-gradient(180deg, #2c3e50, #1a252f);
            transition: all 0.3s;
        }

        .nav-link {
            color: #adb5bd;
            transition: all 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .nav-link.active {
            color: #0d6efd;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        /* Mobile table scrolling */
        @media (max-width: 767.98px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                min-width: 600px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px !important;
                overflow: hidden;
            }

            .sidebar .nav-text,
            .sidebar .user-info {
                display: none;
            }

            .main-content {
                margin-left: 80px !important;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                left: -250px;
            }

            .sidebar.active {
                left: 0;
                width: 250px !important;
            }

            .sidebar.active .nav-text,
            .sidebar.active .user-info {
                display: block;
            }

            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
@endpush

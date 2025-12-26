@section('title', 'Products List')
<div>
    <div class="py-4 container-fluid" id="car-dashboard">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Dashboard Header -->
        <div class="mb-4 row">
            <div class="col-12">
                <div class="text-white shadow-lg card bg-gradient-dark">
                    <div class="p-4 card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 text-white fw-bold">ALL Product List</h2>
                                <p class="mb-0 text-light">Manage your Product inventory </p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('admin.product.create') }}" wire:navigate
                                    class="px-4 py-2 shadow-sm btn btn-light">
                                    <i class="bi bi-plus-lg me-2"></i>Add Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="mb-4 row" id="stats-container">
            <div class="col-xl-3 col-md-6">
                <div class="shadow-sm card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-uppercase font-weight-bold text-muted">Total
                                        Sub-Category
                                    </p>
                                    <h5 class="mb-0 font-weight-bolder" id="total-cars">{{ $products_count }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="text-center icon icon-shape bg-gradient-primary shadow-primary rounded-circle">
                                    <i class="text-lg bi bi-car-front opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="shadow-sm card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-uppercase font-weight-bold text-muted">Available This
                                        Page</p>
                                    <h5 class="mb-0 font-weight-bolder" id="available-cars">
                                        {{ $products->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="text-center icon icon-shape bg-gradient-success shadow-success rounded-circle">
                                    <i class="text-lg bi bi-check-circle opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Main Content Card -->
        <div class="border-0 shadow-lg card">
            <!-- Card Header with Search and Filters -->
            <div class="p-4 bg-white card-header border-bottom">
                <div class="row align-items-center">
                    <div class="mb-3 col-md-6 mb-md-0">
                        <div class="input-group" wire:ignore>
                            <span class="bg-white input-group-text border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0" name="search" id="searchCars"
                                placeholder="Search Products by name,SKU,Stock Status (Active/Inactive)..."
                                value="">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">

                            <div class="btn-group" style="margin-right: 20px;">
                                <button wire:click="$refresh" type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> <span id="current-sort">refresh</span>
                                </button>

                            </div>

                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" id="filterButton">
                                    <i class="bi bi-funnel me-1"></i> <span
                                        id="current-filter">{{ $perPage == 10 ? 'default Show' : $perPage }}</span>
                                </button>
                                <ul class="dropdown-menu" wire:scroll-prevent>
                                    <li wire:click="perPageValueChange(10)"><a class="dropdown-item filter-option"
                                            href="#" data-value="available">10</a></li>
                                    <li wire:click="perPageValueChange(20)"><a class="dropdown-item filter-option"
                                            href="#">20</a></li>
                                    <li wire:click="perPageValueChange(50)"><a class="dropdown-item filter-option"
                                            href="#" data-value="maintenance">50</a></li>
                                    <li wire:click="perPageValueChange(100)"><a class="dropdown-item filter-option"
                                            href="#" data-value="maintenance">100</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    {{-- <li><a class="dropdown-item filter-option" href="#">
                                            Filters</a></li> --}}
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" id="sortButton">
                                    <i class="bi bi-sort-down me-1"></i> <span
                                        id="current-sort">{{ Str::ucfirst(Str::replace('_', ' ', $sortBy)) }}</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li wire:click="sortUpdated('latest')">
                                        <a class="dropdown-item sort-option" href="#">🆕 Latest</a>
                                    </li>
                                    <li wire:click="sortUpdated('Oldest')">
                                        <a class="dropdown-item sort-option" href="#">📜 Oldest</a>
                                    </li>
                                    <li wire:click="sortUpdated('Name(A-Z)')">
                                        <a class="dropdown-item sort-option" href="#">🔤 Name (A-Z)</a>
                                    </li>
                                    <li wire:click="sortUpdated('Name(Z-A)')">
                                        <a class="dropdown-item sort-option" href="#">🔡 Name (Z-A)</a>
                                    </li>
                                    <li wire:click="sortUpdated('Active Product')">
                                        <a class="dropdown-item sort-option" href="#">✅ Active Product</a>
                                    </li>
                                    <li wire:click="sortUpdated('Inactive Product')">
                                        <a class="dropdown-item sort-option" href="#">🚫 Inactive Product</a>
                                    </li>
                                    <li wire:click="sortUpdated('Outofstock Product')">
                                        <a class="dropdown-item sort-option" href="#">❌ Out of Stock</a>
                                    </li>
                                    <li wire:click="sortUpdated('Instock Product')">
                                        <a class="dropdown-item sort-option" href="#">📦 In Stock</a>
                                    </li>
                                    <li wire:click="sortUpdated('Price_High_to_Low')">
                                        <a class="dropdown-item sort-option" href="#">💰 Price: High to Low</a>
                                    </li>
                                    <li wire:click="sortUpdated('Price_Low_to_High')">
                                        <a class="dropdown-item sort-option" href="#">🪙 Price: Low to High</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- loding chilo  --}}

            <!-- Card Body with Table -->
            <div class="p-0 card-body position-relative">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Product-id</th>
                                <th>Product Name</th>
                                <th>Product Slug</th>
                                <th>Product Image</th>
                                <th>Product Regular Price</th>
                                <th>Product Sale Price</th>
                                <th>Product Sku</th>
                                <th>Product Stock-Status</th>
                                <th>Product Quantity</th>
                                <th>is_active</th>
                                <th>is_featured</th>
                                <th>Product Description</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td class="ps-4">
                                        <p class="mb-0 text-sm">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">Category-{{ $product->id }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->slug }}</p>
                                    </td>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                                alt="{{ $product->name }}" width="50">
                                        @else
                                            <p class="mb-0 text-sm">No Image</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->productDetail->regular_price ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->productDetail->discount_price ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->SKU }}</p>
                                    </td>
                                    <td>
                                        @if ($product->stock_status == 'instock')
                                            <p class="mb-0 text-sm text-success">In Stock</p>
                                        @else
                                            <p class="mb-0 text-sm text-danger">Out of Stock</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->quantity }}</p>
                                    </td>
                                    <td>
                                        @if ($product->is_active == 1)
                                            <p class="mb-0 text-sm text-success">Active</p>
                                        @else
                                            <p class="mb-0 text-sm text-danger">Inactive</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $product->is_featured == 1 ? 'Yes' : 'No' }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.detail', $product->id) }}" wire:navigate
                                            class="mb-0 text-sm">Click See More</a>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate
                                            class="btn btn-link text-dark px-3 mb-0">
                                            <i class="bi bi-pencil-square text-info"></i>
                                        </a>
                                        <a onclick="confirmDelete({{ $product->id }})"
                                            class="btn btn-link bg-danger text-white text-gradient px-3 mb-0">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Card Footer with Pagination -->
                    <div class="p-3 bg-white card-footer border-top">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

            <!-- Scrollable modal -->
        </div>
    </div>

</div>
@push('styles')
    <!-- Custom CSS for premium features -->
    <style>
        .bg-gradient-dark {
            background: linear-gradient(145deg, #2c3e50, #1a252f);
        }

        .icon-shape {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .table tr {
            transition: all 0.2s ease;
        }

        .table tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Custom styles for the pagination */
        .pagination {
            margin-bottom: 0;
        }

        .page-item.active .page-link {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-danger-subtle {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-secondary-subtle {
            background-color: rgba(108, 117, 125, 0.1);
        }

        /* Loading animation styles */
        #loading-overlay {
            transition: opacity 0.3s ease;
        }

        /* Added for AJAX loading states */
        .fade-out {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteProduct', {
                        id
                    });
                    Swal.fire(
                        'Deleted!',
                        'Your brand has been deleted.',
                        'success'
                    );
                }
            });



        }

        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized, setting up hooks.');
        });
    </script>
@endpush

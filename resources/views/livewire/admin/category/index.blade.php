@section('title', 'Category List')
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
                                <h2 class="mb-0 text-white fw-bold">ALL Categories List</h2>
                                <p class="mb-0 text-light">Manage your premium vehicle inventory</p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('admin.category.create') }}" wire:navigate
                                    class="px-4 py-2 shadow-sm btn btn-light">
                                    <i class="bi bi-plus-lg me-2"></i>Add New Category
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
                                    <p class="mb-0 text-sm text-uppercase font-weight-bold text-muted">Total Brands
                                    </p>
                                    <h5 class="mb-0 font-weight-bolder" id="total-cars">{{ $categoryCount }}
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
                                    <h5 class="mb-0 font-weight-bolder" id="available-cars">{{ $categories->count() }}
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
                        <div class="input-group">
                            <span class="bg-white input-group-text border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0" name="search"
                                id="searchCars" placeholder="Search cars by name, brand or model..." value="">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" id="filterButton">
                                    <i class="bi bi-funnel me-1"></i> <span id="current-filter">Filter</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item filter-option" href="#"
                                            data-value="available">Available Only</a></li>
                                    <li><a class="dropdown-item filter-option" href="#">Rented
                                            Only</a></li>
                                    <li><a class="dropdown-item filter-option" href="#"
                                            data-value="maintenance">In
                                            Maintenance</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item filter-option" href="#">Reset
                                            Filters</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" id="sortButton">
                                    <i class="bi bi-sort-down me-1"></i> <span id="current-sort">Sort</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item sort-option" href="#">Newest
                                            First</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-value="oldest">Oldest
                                            First</a></li>
                                    <li><a class="dropdown-item sort-option" href="#"
                                            data-value="price_high">Price: High to Low</a></li>
                                    <li><a class="dropdown-item sort-option" href="#"
                                            data-value="price_low">Price:
                                            Low to High</a></li>
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
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Category Slug</th>
                                <th>Category Description</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>

                        @forelse ($categories as $index => $category)
                            <tbody>
                                <tr wire:key="{{ $category->id }}">
                                    <td class="ps-4">
                                        <p class="mb-0 text-sm">{{ $index + 1 }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="mb-0 text-sm">{{ $category->id }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $category->name }}</p>
                                    </td>
                                    <td>
                                        <img height="50px" width="50px"
                                            src="{{ asset('storage/uploads/categories/' . $category->image) ?? asset('admin/img/no-image.png') }}"
                                            alt="{{ $category->name }}">
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{{ $category->slug }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-sm">{!! Str::limit($category->description, 50) !!}</p>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.category.edit', $category->id) }}" wire:navigate
                                            class="btn btn-link text-dark px-3 mb-0">
                                            <i class="bi bi-pencil-square text-info"></i>
                                        </a>



                                        <a onclick="confirmDelete({{ $category->id }})"
                                            class="btn btn-link bg-danger text-white text-gradient px-3 mb-0">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No brands found.</td>
                            </tr>
                        @endforelse

                    </table>

                    <!-- Card Footer with Pagination -->
                    <div class="p-3 bg-white card-footer border-top">
                        {{ $categories->links() }}
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
                    Livewire.dispatch('deleteCategory', {
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
    </script>
@endpush

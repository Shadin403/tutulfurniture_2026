@section('title', 'Product Details')

<div>
    {{-- @dd($product_gallery_images) --}}
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
                    <div>
                        <a wire:navigate href="{{ route('admin.product.edit', $product_id) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a wire:navigate href="{{ route('admin.all.products') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $Product_name }}</h6>
                        @if (isset($product->status))
                            <span class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Product Image -->
                            <div class="col-md-4 mb-4 mb-md-0">
                                @if (isset($product_image))
                                    <div class="border p-2 text-center">
                                        <img src="{{ asset('storage/uploads/products/' . $product_image) }}"
                                            class="img-fluid" alt="Product Image" style="max-height: 300px;">
                                    </div>
                                @else
                                    <div class="border p-2 text-center bg-light d-flex align-items-center justify-content-center"
                                        style="height: 300px;">
                                        <span class="text-muted">No image available</span>
                                    </div>
                                @endif

                                <!-- Gallery Images -->
                                @if ($product_gallery_images)

                                    @if (isset($product_gallery_images) && count($product_gallery_images) > 0)

                                        <div class="mt-3">
                                            <h6 class="font-weight-bold">Gallery Images</h6>
                                            <div class="row">
                                                @foreach ($product_gallery_images as $image)
                                                    <div class="col-3 mb-2">
                                                        <img src="{{ asset('storage/uploads/products/gallery/' . $image) }}"
                                                            class="img-thumbnail" alt="Gallery image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="border p-2 text-center bg-light d-flex align-items-center justify-content-center"
                                        style="height: 100px;">
                                        <span class="text-muted
                                        ">No gallery
                                            images available</span>
                                    </div>

                                @endif
                            </div>

                            <!-- Product Information -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h5 class="font-weight-bold border-bottom pb-2">Basic Information</h5>
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th width="40%">Product ID</th>
                                                        <td>{{ $product_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name:</th>
                                                        <td>{{ $Product_name }}</td>
                                                    </tr>

                                                    @if (isset($brand_name))
                                                        <tr>
                                                            <th>Brand Name:</th>
                                                            <td>{{ $brand_name ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endif
                                                    @if (isset($category_name))
                                                        <tr>
                                                            <th>Category:</th>
                                                            <td>{{ $category_name ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endif
                                                    @if (isset($sub_category_name))
                                                        <tr>
                                                            <th>Subcategory:</th>
                                                            <td>{{ $sub_category_name ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <th>Regular Price:</th>
                                                        <td>৳{{ number_format($regular_price, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount Price:</th>
                                                        <td>
                                                            @if ($discount_price)
                                                                <span class="text-success ml-2">
                                                                    {{ $discount_price ? '৳' . number_format($discount_price, 2) : 'N/A' }}
                                                                </span>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stock Quantity:</th>
                                                        <td>

                                                            @if ($stock_status == 'instock')
                                                                <span class="text-success ml-2">
                                                                    In Stock
                                                                </span>
                                                            @else
                                                                <span class="text-danger ml-2">
                                                                    Out of Stock
                                                                </span>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h5 class="font-weight-bold border-bottom pb-2">Product Details</h5>
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th width="40%">Material</th>
                                                        <td>{{ $material ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Weight</th>
                                                        <td>{{ $weight ? $weight . ' kg' : 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Color</th>
                                                        <td>{{ $color ?? 'N/A' }}</td>
                                                    </tr>
                                                    @if (isset($product->created_at))
                                                        <tr>
                                                            <th>Created At</th>
                                                            <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Last Updated</th>
                                                            <td>{{ $product->updated_at->format('d M Y, h:i A') }}</td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <th>Discount Until:</th>
                                                        <td>{{ $discount_time ?? 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dimensions -->

                                <div class="mb-4">
                                    <h5 class="font-weight-bold border-bottom pb-2">Dimensions</h5>
                                    <td>

                                        @if ($dimensions)
                                            @foreach ($dimensions as $key => $value)
                                                <span class="mr-2 mb-2 p-2 text-black">

                                                    {{ $key }}: {{ $value }}
                                                </span>
                                            @endforeach

                                        @endif
                                    </td>
                                    {{-- <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Length</th>
                                                <th>Width</th>
                                                <th>Height</th>
                                                <th>Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach (json_decode($dimensions) as $key => $value)
                                                    <td>{{ $value }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table> --}}


                                </div>


                                {{-- <!-- Available Sizes -->
                                @if ($size)
                                    <div class="mb-4">
                                        <h5 class="font-weight-bold border-bottom pb-2">Available Sizes</h5>
                                        <div class="d-flex flex-wrap">
                                            @foreach (json_decode($size) as $sizeValue)
                                                <span class="badge badge-info mr-2 mb-2 p-2">{{ $sizeValue }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif --}}

                                <!-- Short Description -->
                                @if ($short_description)
                                    <div class="mb-4">
                                        <h5 class="font-weight-bold border-bottom pb-2">Short Description</h5>
                                        <p>{!! $short_description !!}</p>
                                    </div>
                                @endif

                                <!-- Extra Info -->
                                @if ($extra_info)
                                    <div class="mb-4">
                                        <h5 class="font-weight-bold border-bottom pb-2">Additional Information</h5>
                                        <p>{{ $extra_info }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Full Description -->
                        @if ($description)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="font-weight-bold border-bottom pb-2">Full Description</h5>
                                    <div class="p-3 bg-light rounded">
                                        {!! $description !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Inventory & Statistics -->
                        @if (isset($product->sku) ||
                                isset($product->stock_quantity) ||
                                isset($product->total_sales) ||
                                isset($product->views) ||
                                isset($product->rating))
                            <div class="row mt-4">
                                @if (isset($product->sku) || isset($product->stock_quantity))
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold border-bottom pb-2">Inventory</h5>
                                        <table class="table table-sm">
                                            <tbody>
                                                @if (isset($product->sku))
                                                    <tr>
                                                        <th width="40%">SKU</th>
                                                        <td>{{ $product->sku ?? 'N/A' }}</td>
                                                    </tr>
                                                @endif
                                                @if (isset($product->stock_quantity))
                                                    <tr>
                                                        <th>Stock Quantity</th>
                                                        <td>
                                                            {{ $product->stock_quantity ?? 0 }}
                                                            @if ($product->stock_quantity < 10)
                                                                <span class="badge badge-danger ml-2">Low Stock</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if (isset($product->total_sales) || isset($product->views) || isset($product->rating))
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold border-bottom pb-2">Statistics</h5>
                                        <table class="table table-sm">
                                            <tbody>
                                                @if (isset($product->total_sales))
                                                    <tr>
                                                        <th width="40%">Total Sales</th>
                                                        <td>{{ $product->total_sales ?? 0 }}</td>
                                                    </tr>
                                                @endif
                                                @if (isset($product->views))
                                                    <tr>
                                                        <th>Views</th>
                                                        <td>{{ $product->views ?? 0 }}</td>
                                                    </tr>
                                                @endif
                                                @if (isset($product->rating))
                                                    <tr>
                                                        <th>Rating</th>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-warning mr-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $product->rating)
                                                                            <i class="fas fa-star"></i>
                                                                        @elseif($i - 0.5 <= $product->rating)
                                                                            <i class="fas fa-star-half-alt"></i>
                                                                        @else
                                                                            <i class="far fa-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                {{ $product->rating }} / 5
                                                                <span
                                                                    class="ml-2">({{ $product->reviews_count ?? 0 }}
                                                                    reviews)</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button onclick="confirmDelete({{ $product_id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>

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
    </script>
@endpush

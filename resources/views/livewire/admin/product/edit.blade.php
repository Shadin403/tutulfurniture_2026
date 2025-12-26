@section('title', 'Edit Product')

<div>
    <div class="container mt-4">
        @if (session()->has('success'))
            <div class="border-4 shadow-sm alert alert-success alert-dismissible fade show border-start border-success"
                role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="border-4 shadow-sm alert alert-danger alert-dismissible fade show border-start border-danger"
                role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="overflow-hidden border-0 shadow-lg card rounded-3">
            <div class="p-4 border-0 card-header bg-gradient-primary">
                <h4 class="mb-0 text-white">
                    <i class="bi bi-box-seam me-2"></i> {{ isset($product_id) ? 'Update' : 'Add New' }} Product
                    Information
                </h4>
            </div>
            <div class="p-4 card-body">
                <form wire:submit.prevent="updateProduct" class="needs-validation">
                    <!-- Basic Information Section -->
                    <div class="mb-4 row">
                        <div class="col-md-12">
                            <div class="mb-3 d-flex align-items-center">
                                <span class="p-2 badge bg-primary rounded-circle me-2">
                                    <i class="bi bi-info-circle"></i>
                                </span>
                                <h5 class="mb-0 text-primary fw-bold">Basic Information</h5>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name" placeholder="Enter Product name">
                                <label for="name"><i class="bi bi-tag me-1"></i> Product Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    id="slug" wire:model="slug" placeholder="Enter Product Slug">
                                <label for="slug"><i class="bi bi-link-45deg me-1"></i> Product Slug</label>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('SKU') is-invalid @enderror"
                                    id="SKU" wire:model="SKU" placeholder="Enter Product SKU">
                                <label for="SKU"><i class="bi bi-upc-scan me-1"></i> Product SKU</label>
                                @error('SKU')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    id="quantity" wire:model="quantity" placeholder="Enter product quantity">
                                <label for="quantity"><i class="bi bi-123 me-1"></i> Quantity</label>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id"
                                    wire:model="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand_id"><i class="bi bi-award me-1"></i> Brand</label>
                                @error('brand_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- Category Dropdown -->
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                    wire:model.live="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="category_id"><i class="bi bi-folder me-1"></i> Category</label>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- Sub-Category Dropdown -->
                                <select :disabled="@js($category_id) === null"
                                    class="form-select @error('sub_category_id') is-invalid @enderror"
                                    id="sub_category_id" wire:model="sub_category_id">
                                    <option value="">Select Sub Category</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            {{ $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                        @if ($subCategory == null)
                                            <option value="">Not Available</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="sub_category_id"><i class="bi bi-folder-symlink me-1"></i> Sub
                                    Category
                                </label>
                                <p class="text-info" wire:loading wire:target="category_id">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Loading Sub-Categories
                                </p>

                                {{-- @if ($sub_category_id != null)
                                    <p class="text-success" wire:loading.remove wire:target="category_id">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Sub-Categories Selected
                                    </p>
                                @else
                                    @if ($subCategories != null)
                                        <p class="text-info" wire:loading.remove wire:target="category_id">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Sub-Categories Loaded
                                        </p>
                                        @if ($subCategories->isEmpty())
                                            <p class="text-danger">
                                                <i class="bi bi-x-circle me-1"></i>
                                                No Sub-Categories Available
                                            </p>
                                        @endif

                                        @if (!$subCategories->isEmpty())
                                            <p class="text-success">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Sub Category Available {{ $subCategories->count() }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            First Select a Category
                                        </p>
                                    @endif
                                @endif --}}


                                @error('sub_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('stock_status') is-invalid @enderror"
                                    id="stock_status" wire:model="stock_status">
                                    <option value="">Select Stock Status</option>
                                    <option value="instock" class="text-success">In Stock</option>
                                    <option value="outofstock" class="text-danger">Out of Stock</option>
                                </select>
                                <label for="stock_status"><i class="bi bi-toggle-on me-1"></i> Stock Status</label>
                                @error('stock_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div x-data="{ uploading: false, progress: 0 }" class="col-md-6" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-image me-1"></i> Product Image</label>
                                <div class="input-group">
                                    <span class="text-white input-group-text bg-primary"><i
                                            class="bi bi-camera"></i></span>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" wire:model="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    @if ($image && is_object($image))
                                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail"
                                            style="max-height: 100px">
                                    @elseif($oldImage)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/uploads/products/' . $oldImage) }}"
                                                class="img-thumbnail" style="max-height: 100px">
                                            <span class="ms-2 badge bg-info">Current Image</span>
                                        </div>
                                    @endif
                                </div>
                                <div x-show="uploading" class=" mt-3">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            :style="'width: ' + progress + '%'" :aria-valuenow="progress"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <span x-text="progress + '%'"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ uploading: false, progress: 0 }" class="col-md-6" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-images me-1"></i> Gallery Images</label>
                                <div class="input-group">
                                    <span class="text-white input-group-text bg-primary"><i
                                            class="bi bi-images"></i></span>
                                    <input type="file"
                                        class="form-control @error('gallery_images') is-invalid @enderror"
                                        id="gallery_images" wire:model="gallery_images" multiple>
                                    @error('gallery_images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2 d-flex flex-wrap gap-2">
                                    @if ($gallery_images && is_array($gallery_images))
                                        @foreach ($gallery_images as $image)
                                            @if (is_object($image))
                                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail"
                                                    style="max-height: 80px">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                @if ($oldGalleryImages)
                                    <div class="mt-3">
                                        <h6 class="text-muted">Current Gallery Images</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php
                                                $galleryArray = is_string($oldGalleryImages)
                                                    ? json_decode($oldGalleryImages, true)
                                                    : $oldGalleryImages;
                                            @endphp

                                            @if (is_array($galleryArray))
                                                @foreach ($galleryArray as $index => $img)
                                                    <div class="position-relative">
                                                        <img src="{{ asset('storage/uploads/products/gallery/' . $img) }}"
                                                            class="img-thumbnail" style="max-height: 80px">
                                                        <button type="button"
                                                            wire:click="removeGalleryImage({{ $index }})"
                                                            class="position-absolute top-0 end-0 btn btn-danger btn-sm rounded-circle"
                                                            style="margin-top: -10px; margin-right: -10px;">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div x-show="uploading" class=" mt-3">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            :style="'width: ' + progress + '%'" :aria-valuenow="progress"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <span x-text="progress + '%'"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="featured"
                                    wire:model="featured" {{ $featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    <i class="bi bi-star-fill me-1"></i> Featured Product
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                    wire:model="is_active" {{ $is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="bi bi-eye-fill me-1"></i> Active Product
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Pricing Section -->
                    <div class="mt-5 mb-4 row">
                        <div class="col-md-12">
                            <div class="mb-3 d-flex align-items-center">
                                <span class="p-2 badge bg-primary rounded-circle me-2">
                                    $
                                </span>
                                <h5 class="mb-0 text-primary fw-bold">Product Pricing</h5>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01"
                                    class="form-control @error('regular_price') is-invalid @enderror"
                                    id="regular_price" wire:model="regular_price" placeholder="Enter regular price">
                                <label for="regular_price"><i class="bi bi-tag-fill me-1"></i> Regular Price</label>
                                @error('regular_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01"
                                    class="form-control @error('discount_price') is-invalid @enderror"
                                    id="discount_price" wire:model="discount_price"
                                    placeholder="Enter discount price">
                                <label for="discount_price"><i class="bi bi-percent me-1"></i> Discount Price</label>

                                @error('discount_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="discount_time"
                                    wire:model="discount_time" placeholder="Enter discount end time" step="1"
                                    readonly>
                                <label for="discount_time"><i class="bi bi-clock me-1"></i> Discount End Time</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="warranty" wire:model="warranty"
                                    placeholder="Enter warranty information">
                                <label for="warranty"><i class="bi bi-shield-check me-1"></i> Warranty</label>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 ">
                            <h6>{{ __('Dimensions') }}:</h6>
                            <div class="d-flex gap-2">
                                <div class="form-floating">
                                    <input type="text" wire:model='dimensions.length'
                                        class="@error('product_dimensions') is-invalid @enderror form-control"
                                        style="height: 50px;width: 90%;">
                                    <label for="product_dimensions"><i class="bi bi-tag-fill me-1"></i>
                                        দৈর্ঘ্য (Length)</label>
                                    @error('product_dimensions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input type="text" wire:model='dimensions.width'
                                        class="@error('product_dimensions') is-invalid @enderror form-control"
                                        style="height: 50px;width: 90%;">
                                    <label for="product_dimensions"><i class="bi bi-tag-fill me-1"></i>
                                        প্রস্থ (Width)</label>
                                    @error('product_dimensions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <input type="text" wire:model='dimensions.height'
                                        class="@error('product_dimensions') is-invalid @enderror form-control"
                                        style="height: 50px;width: 90%;">
                                    <label for="product_dimensions"><i class="bi bi-tag-fill me-1"></i>
                                        উচ্চ (Height)</label>
                                    @error('product_dimensions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="assembly_required" wire:model="assembly_required"
                                    {{ $assembly_required ? 'checked' : '' }}>
                                <label class="form-check-label" for="assembly_required">
                                    <i class="bi bi-tools me-1"></i> Assembly Required
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details Section -->
                    <div class="mt-5 mb-4 row">
                        <div class="col-md-12">
                            <div class="mb-3 d-flex align-items-center">
                                <span class="p-2 badge bg-primary rounded-circle me-2">
                                    <i class="bi bi-list-check"></i>
                                </span>
                                <h5 class="mb-0 text-primary fw-bold">Product Details & Specifications</h5>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea name="material" class="form-control" id="material" wire:model='material' cols="30" rows="8"></textarea>
                                <label for="material"><i class="bi bi-box-seam me-1"></i> Material</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="color" wire:model="color"
                                    placeholder="Enter color">
                                <label for="color"><i class="bi bi-palette me-1"></i> Color</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="weight"
                                    wire:model="weight" placeholder="Enter weight">
                                <label for="weight"><i class="bi bi-speedometer2 me-1"></i> Weight (kg)</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="indoor_outdoor" wire:model="indoor_outdoor">
                                    <option value="">Select Location</option>
                                    <option value="indoor">Indoor</option>
                                    <option value="outdoor">Outdoor</option>
                                    <option value="both">Both</option>
                                </select>
                                <label for="indoor_outdoor"><i class="bi bi-house-door me-1"></i>
                                    Indoor/Outdoor</label>
                            </div>
                        </div>

                        <!-- Short Description Editor -->
                        <div class="col-md-12">
                            <p><i class="bi bi-card-text me-1"></i> Short Description</p>
                            <div class="form-floating">
                                <div wire:ignore>
                                    <div id="quill-short-description" style="height: 150px;">{!! $short_description !!}
                                    </div>
                                </div>
                                <input type="hidden" wire:model="short_description" id="short_description">
                                <p class="text-danger">{{ $errors->first('short_description') }}</p>
                            </div>
                        </div>

                        <!-- Full Description Editor -->
                        <div class="col-md-12">
                            <p><i class="bi bi-card-text me-1"></i> Full Description</p>
                            <div class="form-floating">
                                <div wire:ignore>
                                    <div id="quill-description" style="height: 350px;">{!! $description !!}</div>
                                </div>
                                <input type="hidden" wire:model="description" id="description">
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            </div>
                        </div>
                    </div>



                    <!-- SEO Section -->
                    <div class="mt-5 mb-4 row">
                        <div class="col-md-12">
                            <div class="mb-3 d-flex align-items-center">
                                <span class="p-2 badge bg-primary rounded-circle me-2">
                                    <i class="bi bi-search"></i>
                                </span>
                                <h5 class="mb-0 text-primary fw-bold">SEO Information</h5>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="meta_title" wire:model="meta_title"
                                    placeholder="Enter meta title">
                                <label for="meta_title"><i class="bi bi-type-h1 me-1"></i> Meta Title</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea class="form-control" id="meta_description" wire:model="meta_description" style="height: 100px"
                                    placeholder="Enter meta description"></textarea>
                                <label for="meta_description"><i class="bi bi-file-text me-1"></i> Meta
                                    Description</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="extra_info" wire:model="extra_info" style="height: 100px"
                                    placeholder="Enter extra information"></textarea>
                                <label for="extra_info"><i class="bi bi-info-circle me-1"></i> Extra
                                    Information</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-5 row">
                        <div class="text-center col-12">
                            @if (isset($product_id))
                                <button type="submit" class="px-5 py-3 shadow btn btn-primary btn-lg me-3">
                                    <i class="bi bi-check-circle me-2"></i> Update Product
                                </button>
                            @else
                                <button type="submit" class="px-5 py-3 shadow btn btn-primary btn-lg me-3">
                                    <i class="bi bi-check-circle me-2"></i> Save Product
                                </button>
                            @endif
                            <a href="{{ route('admin.all.products') }}" wire:navigate
                                class="px-5 py-3 btn btn-outline-secondary btn-lg">
                                <i class="bi bi-x-circle me-2"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this at the end of your content section -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4285f4, #34a853);
        }

        .custom-switch .form-check-input {
            height: 1.5rem;
            width: 3rem;
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4285f4;
            box-shadow: 0 0 0 0.25rem rgba(66, 133, 244, 0.25);
        }

        .card {
            transition: all 0.3s;
        }

        .badge.rounded-circle {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</div>

@push('scripts')
    <script>
        function initQuill() {
            // Short Description Editor
            var quillShort = new Quill('#quill-short-description', {
                theme: 'snow',
                placeholder: 'Enter short description',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }, {
                            'header': 3
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        [{
                            'direction': 'rtl'
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['clean'],
                        ['link', 'image', 'video']
                    ]
                }

            });
            quillShort.on('text-change', function() {
                document.getElementById('short_description').value = quillShort.root.innerHTML;
                @this.set('short_description', quillShort.root.innerHTML);
            });

            // Full Description Editor
            var quillDescription = new Quill('#quill-description', {
                theme: 'snow',
                placeholder: 'Enter full description',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }, {
                            'header': 3
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        [{
                            'direction': 'rtl'
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['clean'],
                        ['link', 'image', 'video']
                    ]
                }

            });
            quillDescription.on('text-change', function() {
                document.getElementById('description').value = quillDescription.root.innerHTML;
                @this.set('description', quillDescription.root.innerHTML);
            });
        }
        document.addEventListener('livewire:navigated', function() {
            initQuill();
        }, {
            once: true
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Custom Video Handler for YouTube
            function youtubeVideoHandler() {
                const range = this.quill.getSelection();
                const url = prompt('Enter YouTube video URL:');
                const match = url.match(
                    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/);
                const videoId = match ? match[1] : null;

                if (videoId) {
                    const embedUrl = 'https://www.youtube.com/embed/' + videoId;
                    this.quill.insertEmbed(range.index, 'video', embedUrl);
                } else {
                    alert('Invalid YouTube URL');
                }
            }

            // Short Description Editor
            var quillShort = new Quill('#quill-short-description', {
                theme: 'snow',
                placeholder: 'Enter short description',
                modules: {
                    toolbar: {
                        container: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'header': 1
                            }, {
                                'header': 2
                            }, {
                                'header': 3
                            }],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'script': 'sub'
                            }, {
                                'script': 'super'
                            }],
                            [{
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }],
                            [{
                                'direction': 'rtl'
                            }],
                            [{
                                'size': ['small', false, 'large', 'huge']
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'font': []
                            }],
                            [{
                                'align': []
                            }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ],
                        handlers: {
                            video: youtubeVideoHandler
                        }
                    }
                }
            });

            quillShort.on('text-change', function() {
                document.getElementById('short_description').value = quillShort.root.innerHTML;
                @this.set('short_description', quillShort.root.innerHTML);
            });

            // Full Description Editor
            var quillDescription = new Quill('#quill-description', {
                theme: 'snow',
                placeholder: 'Enter full description',
                modules: {
                    toolbar: {
                        container: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'header': 1
                            }, {
                                'header': 2
                            }, {
                                'header': 3
                            }],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'script': 'sub'
                            }, {
                                'script': 'super'
                            }],
                            [{
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }],
                            [{
                                'direction': 'rtl'
                            }],
                            [{
                                'size': ['small', false, 'large', 'huge']
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'font': []
                            }],
                            [{
                                'align': []
                            }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ],
                        handlers: {
                            video: youtubeVideoHandler
                        }
                    }
                }
            });

            quillDescription.on('text-change', function() {
                document.getElementById('description').value = quillDescription.root.innerHTML;
                @this.set('description', quillDescription.root.innerHTML);
            });
        });
    </script> --}}
@endpush

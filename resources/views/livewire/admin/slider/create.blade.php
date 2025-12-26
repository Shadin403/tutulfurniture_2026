@section('title', 'Create Slider')

<div>
    <div class="container mt-4">
        @if (Session::has('success'))
            <div class="border-4 shadow-sm alert alert-success alert-dismissible fade show border-start border-success"
                role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="border-4 shadow-sm alert alert-danger alert-dismissible fade show border-start border-danger"
                role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="overflow-hidden border-0 shadow-lg card rounded-3">
            <div class="p-4 border-0 card-header bg-gradient-primary">
                <h4 class="mb-0 text-white">
                    <i class="bi bi-car-front me-2"></i> Create Slider Information
                </h4>
            </div>
            <div class="p-4 card-body">
                <form wire:submit.prevent="save" class="needs-validation">
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
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
                                    <input type="text" class="form-control" wire:model.live.debounce.500ms='title'
                                        id="title" name="title" placeholder="Enter Title....">
                                    <label for="title"><i class="bi bi-tag me-1"></i> Slider Title</label>
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.500ms='subtitle'
                                        id="subtitle" name="subtitle" placeholder="Enter Slider subtitle">
                                    <label for="subtitle"><i class="bi bi-briefcase me-1"></i>Subtitle</label>
                                    <p class="text-danger">{{ $errors->first('subtitle') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.500ms='tagline'
                                        id="tagline" name="tagline" placeholder="Enter Slider tagline">
                                    <label for="tagline"><i class="bi bi-briefcase me-1"></i>Tagline</label>
                                    <p class="text-danger">{{ $errors->first('tagline') }}</p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.500ms='link'
                                        id="link" name="link" placeholder="Enter Slider link">
                                    <label for="link"><i class="bi bi-briefcase me-1"></i>Link</label>
                                    <p class="text-danger">{{ $errors->first('link') }}</p>

                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="text-white input-group-text bg-primary"><i
                                            class="bi bi-camera"></i></span>
                                    <input wire:model='image' type="file" class="form-control" id="image"
                                        name="image" accept="image/*">
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>
                                <div class="mt-2" id="imagepreview">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail"
                                            style="max-width: 200px;">
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
                        </div>
                        <div class="col-md-6 w-full">


                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="status"
                                    wire:model.live.debounce.500ms="status">
                                <label class="form-check-label" for="status">
                                    <i class="bi bi-eye-fill me-1"></i> Active Product
                                </label>
                            </div>
                        </div>




                        <!-- Save Button -->
                        <div class="mt-5 row" x-show="!uploading">
                            <div class="text-center col-12">
                                <button type="submit" class="px-5 py-3 shadow btn btn-primary btn-lg me-3">
                                    <i class="bi bi-check-circle me-2"></i> Save Changes
                                </button>
                                <a href="{{ route('admin.all.sliders') }}" wire:navigate
                                    class="px-5 py-3 btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-x-circle me-2"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this at the end of your content section -->


</div>
@push('styles')
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
@endpush

<div>
    @section('title', 'Settings')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Website Settings</h6>
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <form wire:submit.prevent="saveGeneral">
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control" id="site_name" wire:model="site_name">
                                    @error('site_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_site_logo" class="form-label">Site Logo</label>
                                    <input class="form-control" type="file" id="new_site_logo" wire:model="new_site_logo">
                                    @error('new_site_logo') <span class="text-danger">{{ $message }}</span> @enderror
                                    
                                    @if ($new_site_logo)
                                        <div class="mt-2"><img src="{{ $new_site_logo->temporaryUrl() }}" width="150" alt="Preview"></div>
                                    @elseif ($site_logo)
                                        <div class="mt-2"><img src="{{ asset('storage/' . $site_logo) }}" width="150" alt="Current Logo"></div>
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

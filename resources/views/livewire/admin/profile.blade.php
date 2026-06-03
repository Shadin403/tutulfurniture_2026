<div>
    @section('title', 'Admin Profile')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">My Profile</h6>
                    <form wire:submit.prevent="updateProfile">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" wire:model="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mobile" wire:model="mobile">
                                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">New Password (optional)</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" wire:model="password" placeholder="Leave blank to keep current password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="new_profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="new_profile_image" wire:model="new_profile_image">
                                @error('new_profile_image') <span class="text-danger">{{ $message }}</span> @enderror
                                @if ($new_profile_image)
                                    <div class="mt-2">
                                        <img src="{{ $new_profile_image->temporaryUrl() }}" width="100">
                                    </div>
                                @elseif ($profile_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $profile_image) }}" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'Profile')

<div>
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
</div>

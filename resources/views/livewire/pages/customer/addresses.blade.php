@section('title', 'My Addresses')

<div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h5 fw-bold mb-0">My Addresses</h3>
                <button wire:click="showAddressForm" class="btn btn-primary btn-sm">
                    <svg class="me-1" width="16" height="16" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Address
                </button>
            </div>

            {{-- <!-- Address Form (Visible when adding/editing) -->
        @if ($showAddressForm)
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="h6 mb-0">{{ $editAddressId ? 'Edit Address' : 'Add New Address' }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $editAddressId ? 'updateAddress' : 'saveAddress' }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Recipient Name*</label>
                            <input type="text" wire:model="address.name" class="form-control" required>
                            @error('address.name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number*</label>
                            <input type="tel" wire:model="address.phone" class="form-control" required>
                            @error('address.phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Division*</label>
                            <select wire:model="address.division" class="form-select" required>
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->name }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @error('address.division') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">District*</label>
                            <select wire:model="address.district" class="form-select" required>
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->name }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @error('address.district') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Upazila*</label>
                            <select wire:model="address.upazila" class="form-select" required>
                                <option value="">Select Upazila</option>
                                @foreach ($upazilas as $upazila)
                                    <option value="{{ $upazila->name }}">{{ $upazila->name }}</option>
                                @endforeach
                            </select>
                            @error('address.upazila') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Locality/Union</label>
                            <input type="text" wire:model="address.locality" class="form-control">
                            @error('address.locality') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Postal Code*</label>
                            <input type="text" wire:model="address.postal_code" class="form-control" required>
                            @error('address.postal_code') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Detailed Address*</label>
                            <textarea wire:model="address.address" class="form-control" rows="3" required></textarea>
                            @error('address.address') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Landmark</label>
                            <input type="text" wire:model="address.landmark" class="form-control">
                            @error('address.landmark') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address Type*</label>
                            <select wire:model="address.type" class="form-select" required>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                                <option value="other">Other</option>
                            </select>
                            @error('address.type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="address.is_default" id="defaultAddress">
                                <label class="form-check-label" for="defaultAddress">
                                    Set as default address
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" wire:click="cancelAddressForm" class="btn btn-outline-secondary">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    @if ($editAddressId)
                                        Update Address
                                    @else
                                        Save Address
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif --}}

            <!-- Address List -->
            <div class="row g-4">
                @forelse($addresses as $address)
                    <div class="col-md-6">
                        <div class="card h-100 border-{{ $address->is_default ? 'primary' : 'light' }}">
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-{{ $address->is_default ? 'primary text-white' : 'light' }}">
                                <div>
                                    <span class="fw-bold">{{ ucfirst($address->type) }}</span>
                                    @if ($address->is_default)
                                        <span class="badge bg-white text-primary ms-2">Default</span>
                                    @endif
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                            </path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" wire:click="editAddress({{ $address->id }})">
                                                <svg class="me-2" width="16" height="16" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item"
                                                wire:click="setDefaultAddress({{ $address->id }})"
                                                @if ($address->is_default) disabled @endif>
                                                <svg class="me-2" width="16" height="16" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Set as Default
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger"
                                                wire:click="confirmDelete({{ $address->id }})">
                                                <svg class="me-2" width="16" height="16" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $address->name }}</h5>
                                <p class="card-text">
                                    <span class="d-block">{{ $address->address }}</span>
                                    <span
                                        class="d-block">{{ $address->locality ? $address->locality . ', ' : '' }}{{ $address->upazila }},
                                        {{ $address->district }}</span>
                                    <span class="d-block">{{ $address->division }}, {{ $address->postal_code }}</span>
                                    <span class="d-block">Bangladesh</span>
                                    <span class="d-block mt-2"><strong>Phone:</strong> {{ $address->phone }}</span>
                                    @if ($address->landmark)
                                        <span class="d-block"><strong>Landmark:</strong>
                                            {{ $address->landmark }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <svg width="48" height="48" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <h5 class="mt-3">No Address Found</h5>
                                <p class="text-muted">You haven't added any address yet.</p>
                                <button wire:click="showAddressForm" class="btn btn-primary mt-2">
                                    Add Your First Address
                                </button>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>




</div>

@push('scripts')
    <script>
        // Delete confirmation modal
        window.addEventListener('showDeleteModal', event => {
            $('#deleteAddressModal').modal('show');
        });

        window.addEventListener('hideDeleteModal', event => {
            $('#deleteAddressModal').modal('hide');
        });
    </script>
@endpush

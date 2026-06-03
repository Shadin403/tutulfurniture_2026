<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $mobile;
    public $password;
    public $profile_image;
    public $new_profile_image;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        // Assuming there is a profile_image column, if not, we skip for now or add it later.
        $this->profile_image = $user->profile_image ?? null;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'mobile' => 'required|string|max:20|unique:users,mobile,' . auth()->id(),
            'new_profile_image' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->mobile = $this->mobile;

        if ($this->password) {
            $this->validate(['password' => 'min:6']);
            $user->password = Hash::make($this->password);
        }

        if ($this->new_profile_image) {
            $path = $this->new_profile_image->store('profile_images', 'public');
            $user->profile_image = $path;
            $this->profile_image = $path;
        }

        $user->save();

        session()->flash('success', 'Profile updated successfully.');
        return redirect()->route('admin.profile');
    }

    public function render()
    {
        return view('livewire.admin.profile')->layout('components.layouts.admin');
    }
}

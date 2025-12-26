<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{




    public function registerSave()
    {

        $this->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);

        $this->register();
    }


    protected function register()
    {

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make($this->password),
        ]);

        session()->regenerate();
        $this->dispatch('success', 'Account created successfully');
        Auth::login($user);
        $this->redirect(route('home'), navigate: true);
    }














    public function render()
    {
        sleep(2);
        return view('livewire.auth.register');
    }
}

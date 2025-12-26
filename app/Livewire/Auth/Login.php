<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Login extends Component
{

    // public $email;
    // public $password;

    public $name, $email, $mobile, $password, $password_confirmation, $remember = false, $isRegister = false;

    protected function rules()
    {
        if ($this->isRegister) {
            return [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|numeric|unique:users,mobile',
                'password' => 'required|string|min:8|confirmed',

            ];
        } else {

            return [
                'email' => 'required|email',
                'password' => 'required'
            ];
        }
    }


    // ! login function
    public function loginSave()
    {

        $this->isRegister = false;
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            Cart::instance('wishlist')->destroy();
            session()->flash('success', 'You are logged in');
            $this->redirect(route('home'), navigate: true);
        } else {
            $this->dispatch('error', 'Invalid credentials');
            $this->reset(['password']);
        }
    }


    // ! register function
    public function registerSave()
    {




        $this->register();
    }

    // ! register function
    protected function register()
    {
        $this->isRegister = true;
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make($this->password),
        ]);

        session()->regenerate();
        Auth::login($user);
        $this->redirect(route('home'), navigate: true);
        $this->dispatch('success', 'Account created successfully');
    }

    //!login function

    public function showModalOrHideModal()
    {
        $this->reset(['email', 'password', 'name', 'mobile', 'password_confirmation']);
    }


    public function updated($propertyName)
    {

        $this->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',

        ]);
        $this->validateOnly($propertyName);
    }




    public function render()
    {
        return view('livewire.auth.login');
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    public $name, $phone, $division, $district, $upazila, $postal_code, $address, $locality, $is_default = false;
    public $division_id, $district_id, $upazila_id;
    public $divisions = [], $districts = [], $upazilas = [];
    public $addresses = [], $allAddresses = [];
    public $mode, $type = "home";



    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'postal_code' => 'required|string|max:10',
        'address' => 'required|string|max:500',
        'locality' => 'nullable|string|max:255',
        'is_default' => 'nullable',
    ];



    public function render()
    {
        $cartItems = Cart::instance('cart')->content();
        // dd($cartItems);
        if (Auth::check()) {
            $this->addresses = Address::where('user_id', Auth::user()->id)->where('is_default', 1)->get();
            $this->allAddresses = Address::where('user_id', Auth::user()->id)->get();
        }

        // sleep(1);
        return view('livewire.pages.checkout', [
            'cartItems' => $cartItems
        ]);
    }




    public function mount()
    {

        sleep(1);

        $this->divisions = Division::all();
        $this->name = Auth::user()->name;
    }
    public function updatedDivisionId($value)
    {
        $this->districts = District::where('division_id', $value)->get();
        $this->district_id = null;
        $this->upazila_id = null;
        $this->upazilas = [];
    }

    public function updatedDistrictId($value)
    {
        $this->upazilas = Upazila::where('district_id', $value)->get();
        $this->upazila_id = null;
    }


    public function paymentOption($value)
    {
        $this->mode = $value;
    }




    public function addressSave()
    {
        $this->validate();

        $user = Auth::user();

        $catchDivision = Division::find($this->division_id);
        $catchDistrict = District::find($this->district_id);
        $catchUpazila = Upazila::find($this->upazila_id);

        if (!$catchDivision || !$catchDistrict || !$catchUpazila) {
            $this->dispatch('error', 'Invalid address information.');
            return;
        }

        if ($this->is_default == 1) {
            Address::where('user_id', $user->id)->update(['is_default' => 0]);
        }

        $address = new Address();
        $address->user_id = $user->id;
        $address->name = $this->name;
        $address->phone = $this->phone;
        $address->division = $catchDivision->bn_name;
        $address->district = $catchDistrict->bn_name;
        $address->upazila = $catchUpazila->bn_name;
        $address->postal_code = $this->postal_code;
        $address->locality = $this->locality;
        $address->address = $this->address;
        $address->is_default = $this->is_default;
        $address->save();

        $this->reset(['name', 'phone', 'division_id', 'district_id', 'upazila_id', 'postal_code', 'address', 'locality', 'is_default']);

        $this->dispatch('success', 'Address saved successfully!');
    }

    public function save()
    {
        $this->placeOrder();
    }

    public function setDefaultAddress($addressId)
    {
        Address::where('user_id', Auth::user()->id)->update(['is_default' => 0]);
        Address::where('id', $addressId)->update(['is_default' => 1]);
    }

    protected function setSessionAmount()
    {
        session([
            'checkout.subtotal' => Cart::instance('cart')->subtotal(),
            'checkout.total' => Cart::instance('cart')->total(),
            'checkout.discount' => 0,
            'checkout.tex' => 0
        ]);
    }


    protected function placeOrder()
    {


        if ($this->mode == 'bkash') {
            $this->dispatch('error', 'Bkash payment method is not available yet.');
        } else if ($this->mode == 'nagad') {
            $this->dispatch('error', 'Nagad payment method is not available yet.');
        } else if ($this->mode == 'rocket') {
            $this->dispatch('error', 'Rocket payment method is not available yet.');
        } else if ($this->mode == 'upay') {
            $this->dispatch('error', 'Upay payment method is not available yet.');
        } else {

            if ($this->mode == null) {
                $this->dispatch('error', 'Please select a payment method.');
                return;
            }


            $user = Auth::user();
            Log::info("User_id" . $user->id);


            $address = Address::where('user_id', $user->id)->where('is_default', 1)->first();
            if (!$address) {
                $this->dispatch('error', 'Please add an address.');
                return;
            }
            Log::info("Address" . $address);

            $this->setSessionAmount();
            if (Cart::instance('cart')->count() == 0) {
                $this->dispatch('error', 'Your cart is empty.');
                return;
            }


            Log::info("amount" . $this->setSessionAmount());
            $order = new Order();
            $order->user_id = $user->id;
            $order->subtotal = str_replace(',', '', session('checkout.subtotal'));
            $order->total = str_replace(',', '', session('checkout.total'));
            $order->discount = str_replace(',', '', session('checkout.discount')) ?? 0;
            $order->tex = str_replace(',', '', session('checkout.tex')) ?? 0;
            $order->name = $address->name;
            $order->phone = $address->phone;
            $order->division = $address->division;
            $order->district = $address->district;
            $order->upazila = $address->upazila;
            $order->postal_code = $address->postal_code;
            $order->address = $address->address;
            $order->locality = $address->locality;
            $order->country = 'Bangladesh';
            $order->save();
            Log::info("Order" . $order);
            $order->load('orderItems');
            foreach (Cart::instance('cart')->content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->id;
                $orderItem->quantity = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->save();
                Log::info("OrderItem" . $orderItem);
            }




            if ($this->mode == 'cod') {
                // Handle cash on delivery (COD)
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->order_id = $order->id;
                $transaction->method = $this->mode;
                $transaction->status = 'pending';
                $transaction->save();
                Log::info("Transaction" . $transaction);

                Cart::instance('cart')->destroy();
                session()->forget('checkout.subtotal');
                session()->forget('checkout.total');
                session()->forget('checkout.discount');
                session()->forget('checkout.tax');

                $this->dispatch('success', 'Order placed successfully.');
                $this->dispatch('cart_updated');
            }
        }
    }


    public function check()
    {
        $this->dispatch('success', 'Order placed successfully.');
    }

    public function setAsDefaultAddress()
    {
        $this->is_default = ! $this->is_default;
    }
}

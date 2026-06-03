<?php

namespace App\Livewire\Admin\Staff;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $staff_id, $name, $email, $mobile, $password;
    public $isOpen = false;

    public function render()
    {
        $staffs = User::where('role', 'staff')->paginate(10);
        return view('livewire.admin.staff.index', compact('staffs'))->layout('components.layouts.admin');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->password = '';
        $this->staff_id = '';
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->staff_id,
            'mobile' => 'required|unique:users,mobile,' . $this->staff_id,
        ];

        if (!$this->staff_id) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        User::updateOrCreate(['id' => $this->staff_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => $this->password ? Hash::make($this->password) : User::find($this->staff_id)->password,
            'role' => 'staff'
        ]);

        session()->flash('success', $this->staff_id ? 'Staff Updated Successfully.' : 'Staff Created Successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);
        $this->staff_id = $id;
        $this->name = $staff->name;
        $this->email = $staff->email;
        $this->mobile = $staff->mobile;
    
        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('success', 'Staff Deleted Successfully.');
    }
}

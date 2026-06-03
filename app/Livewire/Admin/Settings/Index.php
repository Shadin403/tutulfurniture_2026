<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $site_name;
    public $site_logo;
    public $new_site_logo;

    public function mount()
    {
        $this->site_name = Setting::where('key', 'site_name')->value('value');
        $this->site_logo = Setting::where('key', 'site_logo')->value('value');
    }

    public function saveGeneral()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'new_site_logo' => 'nullable|image|max:2048'
        ]);

        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $this->site_name]);

        if ($this->new_site_logo) {
            $path = $this->new_site_logo->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
            $this->site_logo = $path;
            $this->new_site_logo = null;
        }

        session()->flash('success', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings.index')->layout('components.layouts.admin');
    }
}

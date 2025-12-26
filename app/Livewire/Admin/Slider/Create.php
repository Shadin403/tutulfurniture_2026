<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slide;
// use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class Create extends Component
{
    use WithFileUploads;

    public $title, $tagline, $subtitle, $image, $status, $link;



    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.slider.create');
    }

    protected $rules = [
        'title' => 'required',
        'tagline' => 'required',
        'subtitle' => 'required',
        'image' => 'required',
        'status' => 'required',
        'link' => 'required',
    ];


    public function updated()
    {
        $this->validate();
    }


    public function save()
    {
        $this->validate();
        $this->create();
    }


    private function create()
    {

        $imageName = null;

        if ($this->image) {
            $image = $this->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/sliders', $imageName, 'public');
        }



        $slider = new Slide();
        $slider->title = $this->title;
        $slider->tagline = $this->tagline;
        $slider->subtitle = $this->subtitle;
        $slider->status = $this->status;
        $slider->image = $imageName;
        $slider->link = $this->link;
        // dd($slider);
        $slider->save();
        session()->flash('success', 'Slider created successfully!');

        $this->reset('title', 'tagline', 'subtitle', 'image', 'status', 'link');
    }
}

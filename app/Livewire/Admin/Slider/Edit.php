<?php

namespace App\Livewire\Admin\Slider;

use Carbon\Carbon;
use App\Models\Slide;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Edit extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $tagline, $link, $image, $slider_id, $oldImage, $status;


    public function mount($id)
    {
        $this->slider_id = $id;
        if (!$id) {
            session()->flash('error', 'Slider not found!');
            return;
        }
        $slider = Slide::find($this->slider_id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->tagline = $slider->tagline;
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->oldImage = $slider->image;
    }



    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.slider.edit');
    }


    protected $rules = [
        'title' => 'required',
        'subtitle' => 'required',
        'tagline' => 'required',
        'link' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        'status' => 'required',
    ];



    public function update()
    {

        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->updateSlider();
    }

    public function updateSlider()
    {
        $this->validate();

        $slider = Slide::findOrFail($this->slider_id);


        if ($this->image instanceof TemporaryUploadedFile) {

            if ($this->oldImage && Storage::disk('public')->exists("uploads/sliders/{$this->oldImage}")) {
                Storage::disk('public')->delete("uploads/sliders/{$this->oldImage}");
            }


            $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('uploads/sliders', $imageName, 'public');


            $slider->image = $imageName;
        } else {
            $slider->image = $this->oldImage;
        }
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->tagline = $this->tagline;
        $slider->link = $this->link;
        $slider->status = $this->status;
        // dd($slider);
        $slider->save();

        session()->flash('success', 'Slider updated successfully!');
        $this->redirect(route('admin.all.sliders'), navigate: true);
    }
}

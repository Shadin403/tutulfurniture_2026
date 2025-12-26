<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slide;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;





    #[Layout('components.layouts.admin')]
    public function render()
    {
        $sliders  = Slide::orderBy('id', 'desc')->paginate(10);
        $sliders_count = Slide::count();

        return view(
            'livewire.admin.slider.index',
            [
                'sliders' => $sliders,
                'sliders_count' => $sliders_count
            ]
        );
    }

    #[On('deleteslider')]
    public function delete($id)
    {
        $slider = Slide::find($id);
        $slider->delete();
        $this->dispatch('sliderDeleted');
    }
}

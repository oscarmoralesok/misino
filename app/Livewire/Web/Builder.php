<?php

namespace App\Livewire\Web;

use App\Models\Product;
use Livewire\Component;

class Builder extends Component
{
    public $products;

    public function mount()
    {
        // Load products that are marked to show in web AND have an SVG shape
        $this->products = Product::where('show_in_web', true)
                                 ->whereNotNull('svg_image')
                                 ->get();
    }

    public function render()
    {
        return view('livewire.web.builder')->layout('layouts.fullscreen'); // Use full screen for 2D canvas
    }
}

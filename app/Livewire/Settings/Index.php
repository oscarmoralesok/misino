<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    public $fuel_price;
    public $km_per_liter;

    public function mount()
    {
        $this->fuel_price = Setting::where('key', 'fuel_price')->first()->value ?? '1950';
        $this->km_per_liter = Setting::where('key', 'km_per_liter')->first()->value ?? '14';
    }

    public function save()
    {
        $this->validate([
            'fuel_price' => 'required|numeric|min:0',
            'km_per_liter' => 'required|numeric|min:0.1',
        ]);

        Setting::updateOrCreate(['key' => 'fuel_price'], ['value' => $this->fuel_price]);
        Setting::updateOrCreate(['key' => 'km_per_liter'], ['value' => $this->km_per_liter]);

        session()->flash('success', 'Configuraciones guardadas correctamente.');
    }

    public function render()
    {
        return view('livewire.settings.index')->layout('layouts.app');
    }
}

<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class CreateEdit extends Component
{
    public $productId;
    public $name = '';
    public $description = '';
    public $base_price = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'base_price' => 'required|numeric|min:0',
    ];

    public function mount($productId = null)
    {
        $this->productId = $productId;
        
        if ($productId) {
            $product = Product::findOrFail($productId);
            
            // if ($product->user_id !== auth()->id()) {
            //     abort(403);
            // }
            
            $this->name = $product->name;
            $this->description = $product->description;
            $this->base_price = $product->base_price;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->productId) {
            // Update
            $product = Product::findOrFail($this->productId);
            
            if ($product->user_id !== auth()->id()) {
                abort(403);
            }
            
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'base_price' => $this->base_price,
            ]);
            session()->flash('success', 'Producto actualizado.');
        } else {
            // Create
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'base_price' => $this->base_price,
            ]);
            session()->flash('success', 'Producto creado.');
        }
        
        $this->dispatch('product-saved');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.products.create-edit');
    }
}

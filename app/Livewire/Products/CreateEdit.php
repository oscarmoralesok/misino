<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $productId;
    public $name = '';
    public $description = '';
    public $base_price = '';
    public $show_in_web = false;
    public $photo;
    public $svg_file;
    public $existingImage = null;
    public $existingSvg = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'base_price' => 'required|numeric|min:0',
        'show_in_web' => 'boolean',
        'photo' => 'nullable|image|max:2048',
        'svg_file' => 'nullable|file|mimetypes:image/svg+xml|max:1024',
    ];

    public function mount($productId = null)
    {
        $this->productId = $productId;
        
        if ($productId) {
            $product = Product::findOrFail($productId);
            
            $this->name = $product->name;
            $this->description = $product->description;
            $this->base_price = $product->base_price;
            $this->show_in_web = $product->show_in_web;
            $this->existingImage = $product->image_url;
            $this->existingSvg = $product->svg_url;
        }
    }

    public function removeImage()
    {
        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
                $product->update(['image' => null]);
            }
        }
        $this->existingImage = null;
        $this->photo = null;
    }

    public function removeSvg()
    {
        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            if ($product->svg_image) {
                Storage::disk('public')->delete($product->svg_image);
                $product->update(['svg_image' => null]);
            }
        }
        $this->existingSvg = null;
        $this->svg_file = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'base_price' => $this->base_price,
            'show_in_web' => $this->show_in_web,
        ];

        // Handle image upload
        if ($this->photo) {
            if ($this->productId) {
                $product = Product::findOrFail($this->productId);
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
            }
            $data['image'] = $this->photo->store('products', 'public');
        }

        // Handle SVG upload
        if ($this->svg_file) {
            if ($this->productId) {
                $product = Product::findOrFail($this->productId);
                if ($product->svg_image) {
                    Storage::disk('public')->delete($product->svg_image);
                }
            }
            $data['svg_image'] = $this->svg_file->store('products/svgs', 'public');
        }

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update($data);
            session()->flash('success', 'Producto actualizado.');
        } else {
            Product::create($data);
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

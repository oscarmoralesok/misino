<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingId = null;
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('product-saved')]
    public function refreshList()
    {
        $this->resetPage();
        $this->reset('editingId', 'showModal');
    }

    public function create()
    {
        $this->editingId = null;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();
        
        session()->flash('success', 'Producto eliminado.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function render()
    {
        $products = auth()->user()->products()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);
        
        return view('livewire.products.index', [
            'products' => $products
        ]);
    }
}

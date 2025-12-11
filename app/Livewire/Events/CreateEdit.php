<?php

namespace App\Livewire\Events;

use App\Models\Client;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $eventId;
    
    // Form fields
    public $client_id = '';
    public $status = 'draft';
    public $event_date;
    public $service_type = '';
    public $event_type_id = '';
    public $start_time;
    public $end_time;
    public $address = '';
    public $latitude = '';
    public $longitude = '';
    public $detail = '';
    public $notes = '';

    // Dynamic Items
    public $items = []; // Array of ['product_id', 'product_name', 'quantity', 'unit_price', 'total']
    
    // Images
    public $newImages = []; // Uploaded files
    public $existingImages = []; // Existing image models
    public $imagesToDelete = []; // IDs of images to delete

    public function mount(Event $event = null)
    {
        if ($event && $event->exists) {
            $this->eventId = $event->id;
            
            $this->client_id = $event->client_id;
            $this->client_id = $event->client_id;
            $this->status = $event->status;
            $this->event_date = $event->event_date->format('Y-m-d');
            $this->service_type = $event->service_type;
            $this->event_type_id = $event->event_type_id;
            $this->start_time = $event->start_time ? $event->start_time->format('H:i') : null;
            $this->end_time = $event->end_time ? $event->end_time->format('H:i') : null;
            $this->address = $event->address;
            $this->latitude = $event->latitude;
            $this->longitude = $event->longitude;
            $this->detail = $event->detail;
            $this->notes = $event->notes;
            
            // Load items
            foreach ($event->items as $item) {
                $this->items[] = [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name, // Keep existing product_name for reference or custom items
                    'description' => $item->description, // Load user detail
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    // 'total' is calculated
                ];
            }
            
            // Load images
            $this->existingImages = $event->images->toArray();
        } else {
            // Defaults
            $this->status = 'draft';
            // Add one empty item row by default
            $this->items[] = [
                'product_id' => '',
                'product_name' => '',
                'description' => '',
                'quantity' => 1,
                'unit_price' => 0,
            ];
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'product_name' => '',
            'description' => '',
            'quantity' => 1,
            'unit_price' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $key)
    {
        // If product_id changes, pre-fill name and price
        if (str_ends_with($key, '.product_id')) {
            $index = explode('.', $key)[0];
            $productId = $this->items[$index]['product_id'];
            
            if ($productId) {
                $product = Product::find($productId);
                if ($product) {
                    $this->items[$index]['unit_price'] = $product->base_price;
                    $this->items[$index]['product_name'] = $product->name;
                }
            }
        }
    }

    public function deleteExistingImage($imageId)
    {
        $this->imagesToDelete[] = $imageId;
        
        // Remove from local array to hide it
        $this->existingImages = array_filter($this->existingImages, function($img) use ($imageId) {
            return $img['id'] != $imageId;
        });
    }

    public function save()
    {
        $this->validate([
            'client_id' => 'required|exists:clients,id',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'service_type' => 'nullable|in:rental,decoration',
            'event_type_id' => 'nullable|exists:event_types,id',
            'detail' => 'nullable|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.description' => 'nullable|string',
            'items.*.product_name' => 'nullable|string|required_without:items.*.product_id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
            'newImages.*' => 'image|max:5120', // 5MB max
        ]);

        $data = [
            'client_id' => $this->client_id,
            'event_date' => $this->event_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'service_type' => $this->service_type,
            'event_type_id' => $this->event_type_id ?: null,
            'detail' => $this->detail,
            'address' => $this->address,
            'latitude' => $this->latitude ?: null,
            'longitude' => $this->longitude ?: null,
            'status' => $this->status,
            'notes' => $this->notes,
        ];

        // Calculate total
        $totalAmount = 0;
        foreach ($this->items as $item) {
            $totalAmount += ($item['quantity'] * $item['unit_price']);
        }
        $data['total_amount'] = $totalAmount;

        if ($this->eventId) {
            $event = Event::find($this->eventId);
            $event->update($data);
        } else {
            $data['user_id'] = auth()->id();
            $event = Event::create($data);
        }

        // Handle Items
        $event->items()->delete();
        foreach ($this->items as $item) {
            $productName = $item['product_name'];
            if (empty($productName) && !empty($item['product_id'])) {
                 $product = Product::find($item['product_id']);
                 $productName = $product ? $product->name : 'Item';
            }

            $event->items()->create([
                'product_id' => $item['product_id'] ?: null,
                'product_name' => $productName,
                'description' => $item['description'] ?? null,
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Handle Image Deletion
        if (!empty($this->imagesToDelete)) {
            foreach ($this->imagesToDelete as $id) {
                $img = $event->images()->find($id);
                if ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }
            }
        }

        // Handle New Images
        if (!empty($this->newImages)) {
            $maxOrder = $event->images()->max('order') ?? -1;
            foreach ($this->newImages as $image) {
                $path = $image->store('event_images', 'public');
                $event->images()->create([
                    'image_path' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'order' => ++$maxOrder,
                ]);
            }
        }

        session()->flash('success', $this->eventId ? 'Evento actualizado.' : 'Evento creado.');
        return redirect()->route('events.show', $event);
    }

    public function render()
    {
        return view('livewire.events.create-edit', [
            'clients' => Client::orderBy('name')->get(),
            'eventTypes' => EventType::orderBy('name')->get(),
            'products' => Product::orderBy('name')->get(),
        ]);
    }
}

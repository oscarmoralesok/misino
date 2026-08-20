<div class="min-h-screen bg-gray-50 dark:bg-gray-900 font-sans flex flex-col" x-data="builderApp()">
    {{-- Header --}}
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center shadow-sm z-10 relative">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-white leading-tight">Diseña tu Evento</h1>
                <p class="text-xs text-gray-500">Arrastra elementos al escenario y armá tu presupuesto</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Total Presupuesto</p>
                <p class="text-2xl font-bold text-primary-600">$<span x-text="totalPrice.toLocaleString()"></span></p>
            </div>
            <button @click="requestQuote" class="btn-primary shadow-lg shadow-primary-500/20">
                Solicitar Presupuesto
            </button>
        </div>
    </header>

    {{-- Main Workspace --}}
    <div class="flex-1 flex overflow-hidden">
        {{-- Sidebar Catalog --}}
        <aside class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col shadow-xl z-10 overflow-y-auto">
            <div class="p-4 flex-1">
                <h2 class="text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider mb-4">Catálogo de Elementos</h2>
                <div class="space-y-3">
                    @foreach($products as $product)
                        <div draggable="true" @dragstart="dragStart($event, {{ $product }}, 'product')" class="cursor-grab bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-3 rounded-xl hover:border-primary-500 dark:hover:border-primary-500 transition-all flex items-center gap-3 group shadow-sm">
                            <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 overflow-hidden flex-shrink-0 flex items-center justify-center p-1">
                                @if($product->svg_url || $product->image_url)
                                    <img src="{{ $product->svg_url ?? $product->image_url }}" class="max-w-full max-h-full object-contain" draggable="false">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-gray-800 dark:text-gray-200 line-clamp-1">{{ $product->name }}</h3>
                                <p class="text-xs font-bold text-primary-500">${{ number_format($product->base_price, 0) }}</p>
                            </div>
                            <button @click="addToStage({{ $product }}, 'product')" class="w-6 h-6 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 group-hover:bg-primary-500 group-hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Canvas Stage --}}
        <main class="flex-1 relative bg-gray-100 dark:bg-gray-900/50 overflow-hidden" 
              @dragover.prevent="dragOver" 
              @drop="dropOnStage($event)"
              @mousemove="moveItem($event)"
              @mouseup="stopDragging"
              @mouseleave="stopDragging">
            
            <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px;"></div>
            
            <div id="stage" class="absolute inset-0 w-full h-full relative" @click.self="selectedItem = null">
                {{-- Placed Items --}}
                <template x-for="item in stageItems" :key="item.id">
                    <div class="absolute cursor-move group" 
                         :class="{'ring-2 ring-primary-500 ring-offset-2 ring-offset-gray-100 dark:ring-offset-gray-900 rounded-lg': selectedItem === item.id}"
                         :style="`left: ${item.x}px; top: ${item.y}px; z-index: ${item.z}; transform: scale(${item.scale}) rotate(${item.rotation}deg); width: ${item.width}px; height: ${item.height}px;`"
                         @mousedown="startDragging($event, item)"
                         @touchstart="startDragging($event, item)">
                        
                        {{-- Controls --}}
                        <div x-show="selectedItem === item.id" 
                             class="absolute -top-12 left-1/2 flex items-center bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-1 gap-1 z-50 origin-bottom"
                             :style="`transform: translateX(-50%) scale(${1 / Math.max(0.1, item.scale)});`">
                            <button @click.stop="item.scale += 0.1" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300" title="Agrandar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </button>
                            <button @click.stop="item.scale = Math.max(0.2, item.scale - 0.1)" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300" title="Achicar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
                            </button>
                            <div class="w-px h-4 bg-gray-200 dark:bg-gray-700 mx-1"></div>
                            <button @click.stop="duplicateItem(item)" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300" title="Duplicar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                            <button @click.stop="removeItem(item.id)" class="p-1.5 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg text-red-500" title="Eliminar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        {{-- Item Content --}}
                        <div class="w-full h-full pointer-events-none drop-shadow-md">
                            <template x-if="item.svg_url">
                                <img :src="item.svg_url" class="w-full h-full object-contain">
                            </template>
                            <template x-if="!item.svg_url">
                                <div class="w-full h-full">
                                    <template x-if="item.image_url">
                                        <img :src="item.image_url" class="w-full h-full object-contain drop-shadow-lg">
                                    </template>
                                    <template x-if="!item.image_url">
                                        <div class="w-full h-full bg-white dark:bg-gray-800 rounded-xl border-2 border-primary-500 flex items-center justify-center shadow-lg p-2 text-center">
                                            <span class="text-xs font-bold text-gray-800 dark:text-white" x-text="item.name"></span>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                        
                        {{-- Price Badge on hover --}}
                        <template x-if="item.type === 'product'">
                            <div class="absolute -bottom-8 left-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-[10px] font-bold px-2 py-1 rounded-md whitespace-nowrap origin-top pointer-events-none"
                                 :style="`transform: translateX(-50%) scale(${1 / Math.max(0.1, item.scale)});`">
                                $<span x-text="item.base_price"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
            
            {{-- Instructions --}}
            <div x-show="stageItems.length === 0" class="absolute inset-0 pointer-events-none flex flex-col items-center justify-center text-gray-400 dark:text-gray-600">
                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="font-medium text-lg">Tu escenario está vacío</p>
                <p class="text-sm mt-1">Arrastrá paneles y productos desde el panel izquierdo</p>
            </div>
        </main>
    </div>
</div>

<script>
function builderApp() {
    return {
        stageItems: [],
        selectedItem: null,
        draggingItem: null,
        dragOffsetX: 0,
        dragOffsetY: 0,
        dragType: null,
        dragData: null,
        maxZ: 10,

        get totalPrice() {
            return this.stageItems
                .filter(i => i.type === 'product')
                .reduce((sum, item) => sum + parseFloat(item.base_price), 0);
        },

        // Native Drag & Drop from Sidebar
        dragStart(e, data, type) {
            this.dragType = type;
            this.dragData = data;
            e.dataTransfer.setData('text/plain', type); // Required for Firefox
        },

        dragOver(e) {
            e.preventDefault();
        },

        dropOnStage(e) {
            e.preventDefault();
            if (!this.dragData) return;

            const stageRect = document.getElementById('stage').getBoundingClientRect();
            let x = e.clientX - stageRect.left;
            let y = e.clientY - stageRect.top;

            this.addToStage(this.dragData, this.dragType, x, y);
            
            this.dragType = null;
            this.dragData = null;
        },

        addToStage(data, type, x = null, y = null) {
            this.maxZ++;
            
            // Default center if no coordinates provided (e.g. clicked button)
            if (x === null) x = window.innerWidth / 2 - 100;
            if (y === null) y = window.innerHeight / 2 - 100;

            let width = 240;
            let height = 240;
            x -= width / 2;
            y -= height / 2;

            const newItem = {
                id: Date.now() + Math.random().toString(36).substring(2, 9),
                type: type,
                x: x,
                y: y,
                z: this.maxZ,
                scale: 1,
                rotation: 0,
                width: width,
                height: height,
                ...data // Copy product or shape data
            };

            this.stageItems.push(newItem);
            this.selectedItem = newItem.id;
        },

        duplicateItem(item) {
            this.maxZ++;
            const newItem = {
                ...item,
                id: Date.now() + Math.random().toString(36).substring(2, 9),
                x: item.x + 20, // Offset slightly so it doesn't hide the original
                y: item.y + 20,
                z: this.maxZ
            };
            this.stageItems.push(newItem);
            this.selectedItem = newItem.id;
        },

        removeItem(id) {
            this.stageItems = this.stageItems.filter(i => i.id !== id);
            if (this.selectedItem === id) this.selectedItem = null;
        },

        // Moving items on stage
        startDragging(e, item) {
            this.selectedItem = item.id;
            this.draggingItem = item;
            
            // Bring to front
            this.maxZ++;
            item.z = this.maxZ;

            const clientX = e.clientX || e.touches?.[0].clientX;
            const clientY = e.clientY || e.touches?.[0].clientY;

            this.dragOffsetX = clientX - item.x;
            this.dragOffsetY = clientY - item.y;
        },

        moveItem(e) {
            if (!this.draggingItem) return;

            const clientX = e.clientX || e.touches?.[0].clientX;
            const clientY = e.clientY || e.touches?.[0].clientY;

            this.draggingItem.x = clientX - this.dragOffsetX;
            this.draggingItem.y = clientY - this.dragOffsetY;
        },

        stopDragging() {
            this.draggingItem = null;
        },

        requestQuote() {
            if (this.totalPrice === 0) {
                alert('Aún no has agregado productos al presupuesto.');
                return;
            }

            let text = 'Hola! Quiero solicitar un presupuesto con los siguientes elementos de mi diseño:\n\n';
            
            const products = this.stageItems.filter(i => i.type === 'product');
            
            // Group by name
            const counts = {};
            products.forEach(p => {
                counts[p.name] = (counts[p.name] || 0) + 1;
            });

            for (const [name, qty] of Object.entries(counts)) {
                text += `• ${qty}x ${name}\n`;
            }

            text += `\n*Total estimado: $${this.totalPrice.toLocaleString()}*`;

            const phone = '5493510000000'; // Placeholder, replace with real WhatsApp number or setting
            window.open(`https://wa.me/${phone}?text=${encodeURIComponent(text)}`, '_blank');
        }
    }
}
</script>

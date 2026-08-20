<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

// Web Builder (Public)
Route::get('/disena-tu-evento', App\Livewire\Web\Builder::class)->name('web.builder');

Route::get('/dashboard', App\Livewire\Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transactions - Livewire
    Route::get('/transactions', App\Livewire\Transactions\Index::class)->name('transactions.index');
    Route::get('/transactions/{transaction}/receipt', [App\Http\Controllers\TransactionController::class, 'downloadReceipt'])->name('transactions.receipt');
    
    // Events - Hybrid (Index=Livewire, Create/Edit/Show=Controller)
    Route::get('/events', App\Livewire\Events\Index::class)->name('events.index');
    Route::get('/events/create', App\Livewire\Events\CreateEdit::class)->name('events.create');
    Route::get('/events/{event}', App\Livewire\Events\Show::class)->name('events.show');
    Route::get('/events/{event}/edit', App\Livewire\Events\CreateEdit::class)->name('events.edit');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::patch('/events/{event}/confirm', [EventController::class, 'confirm'])->name('events.confirm');
    Route::delete('/events/{event}/images/{image}', [EventController::class, 'destroyImage'])->name('events.images.destroy');
    Route::get('/events/{event}/pdf', [EventController::class, 'downloadPdf'])->name('events.pdf');
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
    // Clients - Livewire
    Route::get('/clients', App\Livewire\Clients\Index::class)->name('clients.index');
    // Products - Livewire
    Route::get('/products', App\Livewire\Products\Index::class)->name('products.index');
    // Event Types - Livewire
    Route::get('/event-types', App\Livewire\EventTypes\Index::class)->name('event-types.index');
    Route::get('/calendar', App\Livewire\Calendar::class)->name('calendar.index');
    Route::get('/logistics', App\Livewire\Logistics::class)->name('logistics.index'); // Logistics Module
    Route::get('/events-follow-up', App\Livewire\Events\FollowUp::class)->name('events.follow-up'); // Follow-up Module
    Route::get('/settings', App\Livewire\Settings\Index::class)->name('settings.index'); // System Settings
    
    // Serve storage files fallback
    Route::get('/storage-file/{path}', [EventController::class, 'serveFile'])->where('path', '.*')->name('storage.serve');
});

require __DIR__.'/auth.php';

Route::get('/debug-logs', function () {
    $results = [];
    
    // Native function to read last lines of a file
    $getLastLinesNative = function ($filepath, $numLines = 100) {
        if (!file_exists($filepath) || !is_readable($filepath)) {
            return 'File not readable or does not exist';
        }
        
        $fp = fopen($filepath, 'r');
        if (!$fp) return 'Cannot open file';
        
        // Seek from the end of file
        fseek($fp, 0, SEEK_END);
        $size = ftell($fp);
        
        if ($size === 0) {
            fclose($fp);
            return '';
        }
        
        $pos = -2; // Start before the EOF newline
        $lineCount = 0;
        
        while ($lineCount < $numLines && $size + $pos >= 0) {
            fseek($fp, $pos, SEEK_END);
            $char = fgetc($fp);
            if ($char === "\n") {
                $lineCount++;
            }
            $pos--;
        }
        
        // Read the content from this position to the end
        if ($size + $pos < 0) {
            fseek($fp, 0); // start of file
        } else {
            fseek($fp, $pos + 2, SEEK_END);
        }
        
        $text = fread($fp, $size);
        fclose($fp);
        return $text;
    };
    
    $results['current_user_name'] = get_current_user();
    
    // Check relative error_log file paths
    $possibleRelativeLogs = [
        public_path('error_log'),
        base_path('error_log'),
        storage_path('error_log'),
        base_path('../error_log'),
    ];
    
    $results['found_logs'] = [];
    foreach ($possibleRelativeLogs as $path) {
        if (file_exists($path)) {
            $results['found_logs'][] = [
                'path' => $path,
                'readable' => is_readable($path),
                'size' => filesize($path),
                'content' => is_readable($path) ? $getLastLinesNative($path, 100) : 'Not readable'
            ];
        }
    }
    
    // Laravel Log Check
    $laravelLog = storage_path('logs/laravel.log');
    $results['laravel_log_path'] = $laravelLog;
    $results['laravel_log_exists'] = file_exists($laravelLog);
    if (file_exists($laravelLog)) {
        $results['laravel_log_readable'] = is_readable($laravelLog);
        $results['laravel_log_size'] = filesize($laravelLog);
        if (is_readable($laravelLog)) {
            $results['laravel_log'] = $getLastLinesNative($laravelLog, 100);
        }
    } else {
        $results['logs_dir_writable'] = is_writable(storage_path('logs'));
    }

    // Check key PDF assets
    $results['assets'] = [
        'header' => [
            'path' => public_path('img/pdf/header.png'),
            'exists' => file_exists(public_path('img/pdf/header.png')),
            'readable' => is_readable(public_path('img/pdf/header.png')),
            'size' => file_exists(public_path('img/pdf/header.png')) ? filesize(public_path('img/pdf/header.png')) : 0,
        ],
        'footer' => [
            'path' => public_path('img/pdf/footer.png'),
            'exists' => file_exists(public_path('img/pdf/footer.png')),
            'readable' => is_readable(public_path('img/pdf/footer.png')),
            'size' => file_exists(public_path('img/pdf/footer.png')) ? filesize(public_path('img/pdf/footer.png')) : 0,
        ],
    ];

    return response()->json($results);
});

Route::get('/test-pdf', function () {
    try {
        $headerPath = public_path('img/pdf/header.png');
        $html = '<h1>Test Image</h1><p>Path: ' . $headerPath . '</p>';
        if (file_exists($headerPath)) {
            $html .= '<img src="' . $headerPath . '" style="width: 100%; height: auto;" />';
        } else {
            $html .= '<p>File does not exist.</p>';
        }
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download('test.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});

Route::get('/test-pdf-event/{id}', function ($id) {
    try {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $event = \App\Models\Event::findOrFail($id);
        $event->load(['client', 'items', 'images']);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('events.pdf', compact('event'));
        return $pdf->download('presupuesto-' . $event->id . '.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});

Route::get('/test-html-event/{id}', function ($id) {
    $event = \App\Models\Event::findOrFail($id);
    $event->load(['client', 'items', 'images']);
    
    $imageStatus = [];
    foreach ($event->images as $image) {
        $path = storage_path('app/public/' . $image->image_path);
        $imageStatus[] = [
            'db_path' => $image->image_path,
            'full_path' => $path,
            'exists' => file_exists($path),
            'readable' => is_readable($path),
            'size' => file_exists($path) ? filesize($path) : 0,
        ];
    }
    
    // Also check other pdf assets
    $pin = public_path('img/pdf/pin.png');
    $hand = public_path('img/pdf/hand.png');
    
    return response()->json([
        'event_id' => $event->id,
        'images_count' => $event->images->count(),
        'images_status' => $imageStatus,
        'pin_icon' => [
            'path' => $pin,
            'exists' => file_exists($pin),
            'readable' => is_readable($pin),
        ],
        'hand_icon' => [
            'path' => $hand,
            'exists' => file_exists($hand),
            'readable' => is_readable($hand),
        ],
        'html_url' => url('/test-html-event-raw/' . $id)
    ]);
});

Route::get('/test-html-event-raw/{id}', function ($id) {
    $event = \App\Models\Event::findOrFail($id);
    $event->load(['client', 'items', 'images']);
    return view('events.pdf', compact('event'));
});

Route::get('/test-pdf-layout', function () {
    try {
        $html = '<!DOCTYPE html>
<html>
    <head>
        <style>
            @page { margin: 0cm 0cm; }
            body {
                margin-top: 4cm; margin-left: 1cm; margin-right: 1cm; margin-bottom: 3cm;
                font-family: "DejaVu Sans", sans-serif;
            }
            header {
                position: fixed; top: 0cm; left: 0cm; right: 0cm; height: 4cm;
            }
            img.header-img { width: 100%; height: auto; }
            footer {
                position: fixed; bottom: 0cm; left: 0cm; right: 0cm; height: 1.8cm;
            }
            img.footer-img { width: 100%; height: auto; }
        </style>
    </head>
    <body>
        <header>
            <img src="' . public_path('img/pdf/header.png') . '" class="header-img"/>
        </header>
        <footer>
            <img src="' . public_path('img/pdf/footer.png') . '" class="footer-img"/>
        </footer>
        <h1>Hello World</h1>
    </body>
</html>';
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download('test-layout.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});

Route::get('/test-pdf-event-clean/{id}', function ($id) {
    try {
        $event = \App\Models\Event::findOrFail($id);
        $event->load(['client', 'items', 'images']);
        
        // Clean event data
        $event->detail = 'EVENT DETAIL CLEAN ASCII';
        $event->notes = 'EVENT NOTES CLEAN ASCII';
        
        // Clean client
        if ($event->client) {
            $event->client->name = 'CLIENT NAME ASCII';
            $event->client->phone = '123456789';
            $event->client->email = 'client@example.com';
        }
        
        // Clean items
        foreach ($event->items as $item) {
            $item->product_name = 'PRODUCT NAME ASCII';
            $item->description = 'PRODUCT DESCRIPTION ASCII';
        }
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('events.pdf', compact('event'));
        return $pdf->download('presupuesto-' . $event->id . '.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});

Route::get('/test-pdf-event-no-images/{id}', function ($id) {
    try {
        $event = \App\Models\Event::findOrFail($id);
        $event->load(['client', 'items', 'images']);
        
        $html = view('events.pdf', compact('event'))->render();
        
        // Remove pin.png and hand.png from html
        $html = str_replace(public_path('img/pdf/pin.png'), '', $html);
        $html = str_replace(public_path('img/pdf/hand.png'), '', $html);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download('presupuesto-' . $event->id . '.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});

Route::get('/test-pdf-custom-html/{id}', function ($id) {
    try {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $event = \App\Models\Event::findOrFail($id);
        $event->load(['client', 'items', 'images']);
        
        $html = view('events.pdf', compact('event'))->render();
        
        if (request()->has('no_css')) {
            $html = preg_replace('/<style>.*?<\/style>/s', '', $html);
        }
        if (request()->has('no_header_footer')) {
            $html = preg_replace('/<header>.*?<\/header>/s', '', $html);
            $html = preg_replace('/<footer>.*?<\/footer>/s', '', $html);
        }
        if (request()->has('no_table')) {
            $html = preg_replace('/<table class="items-table">.*?<\/table>/s', '', $html);
        }
        if (request()->has('no_info_table')) {
            $html = preg_replace('/<table class="info-table">.*?<\/table>/s', '', $html);
        }
        if (request()->has('no_alert')) {
            $html = preg_replace('/<div class="alert-box">.*?<\/div>/s', '', $html);
        }
        if (request()->has('no_notes')) {
            $html = preg_replace('/NOTAS:.*?<\/div>/s', '', $html);
        }
        if (request()->has('no_terms')) {
            // Remove the block at the bottom
            $html = preg_replace('/<div style="margin-top: 30px; font-size: 0.85em; color: #333;">.*?<\/div>/s', '', $html);
        }
        
        if (request()->has('raw_html')) {
            return $html;
        }
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download('test-custom.pdf');
    } catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString())
        ], 500);
    }
});


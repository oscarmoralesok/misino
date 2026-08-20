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

    return response()->json($results);
});


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
    
    // 1. PHP Info / Error Log path
    $errorLogPath = ini_get('error_log');
    $results['php_error_log_path'] = $errorLogPath;
    if ($errorLogPath && file_exists($errorLogPath) && is_readable($errorLogPath)) {
        $results['php_error_log_content'] = shell_exec('tail -n 100 ' . escapeshellarg($errorLogPath));
    } else {
        $results['php_error_log_content'] = 'Not found or not readable';
    }
    
    // 2. Web Server Error Log (Apache, Nginx, etc.)
    $webServerLogs = [
        '/var/log/apache2/error.log',
        '/var/log/apache2/error_log',
        '/var/log/httpd/error_log',
        '/var/log/nginx/error.log',
    ];
    $results['web_server_log'] = 'Not readable or not found';
    foreach ($webServerLogs as $logPath) {
        if (file_exists($logPath) && is_readable($logPath)) {
            $results['web_server_log_path'] = $logPath;
            $results['web_server_log'] = shell_exec('tail -n 100 ' . escapeshellarg($logPath));
            break;
        }
    }
    
    // 3. Laravel Log
    $laravelLog = storage_path('logs/laravel.log');
    if (file_exists($laravelLog) && is_readable($laravelLog)) {
        $results['laravel_log'] = shell_exec('tail -n 100 ' . escapeshellarg($laravelLog));
    } else {
        $results['laravel_log'] = 'Not readable or not found';
    }

    return response()->json($results);
});


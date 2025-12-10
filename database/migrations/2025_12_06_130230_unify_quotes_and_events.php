<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create event_items table
        Schema::create('event_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });

        // 2. Add columns to events table
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            // We need to support more statuses. 
            // If it was enum, we might need to change it. 
            // For simplicity/robustness, let's allow string.
            // Status was dropped in previous migration, so we create it anew.
            $table->string('status')->default('pending'); 
        });

        // 3. Migrate Data
        $quotes = DB::table('quotes')->get();
        foreach ($quotes as $quote) {
            $eventId = $quote->event_id;
            
            // Map status
            $status = match($quote->status) {
                'accepted' => 'confirmed',
                'rejected' => 'cancelled',
                default => $quote->status // draft, sent
            };

            if ($eventId) {
                // Update existing event
                DB::table('events')->where('id', $eventId)->update([
                    'total_amount' => $quote->total_amount,
                    'notes' => $quote->notes,
                    'status' => $status === 'confirmed' ? 'confirmed' : 'pending', // If it was already an event, it was likely confirmed
                ]);
            } else {
                // Create new event from quote
                $eventId = DB::table('events')->insertGetId([
                    'user_id' => $quote->user_id,
                    'client_id' => $quote->client_id,
                    'event_date' => $quote->event_date,
                    'start_time' => $quote->start_time,
                    'end_time' => $quote->end_time,
                    'service_type' => $quote->service_type,
                    'event_type_id' => $quote->event_type_id,
                    'status' => $status,
                    'detail' => 'Presupuesto #' . $quote->id, // Fallback detail
                    'total_amount' => $quote->total_amount,
                    'notes' => $quote->notes,
                    'created_at' => $quote->created_at,
                    'updated_at' => $quote->updated_at,
                ]);
            }

            // Migrate Items
            $quoteItems = DB::table('quote_items')->where('quote_id', $quote->id)->get();
            foreach ($quoteItems as $item) {
                DB::table('event_items')->insert([
                    'event_id' => $eventId,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total' => $item->total,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }

        // 4. Drop old tables
        Schema::dropIfExists('quote_items');
        Schema::dropIfExists('quotes');
    }

    public function down(): void
    {
        // This is a destructive migration, hard to reverse perfectly without complex logic.
        // We will just recreate tables but data restoration is manual.
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            // ... (simplified reconstruction)
            $table->timestamps();
        });
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::dropIfExists('event_items');
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'notes']);
        });
    }
};

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
        DB::table('events')->delete();
        
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('detail')->nullable();
            
            // Drop old columns
            $table->dropColumn(['name', 'client_name', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('name');
            $table->string('client_name')->nullable();
            $table->enum('status', ['pending', 'completed', 'paid'])->default('pending');
            
            $table->dropForeign(['client_id']);
            $table->dropColumn(['client_id', 'start_time', 'end_time', 'detail']);
        });
    }
};

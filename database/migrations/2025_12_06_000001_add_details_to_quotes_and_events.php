<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('service_type')->nullable()->after('client_id'); // 'rental' or 'decoration'
            $table->foreignId('event_type_id')->nullable()->after('service_type')->constrained()->nullOnDelete();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('service_type')->nullable()->after('client_id');
            $table->foreignId('event_type_id')->nullable()->after('service_type')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['event_type_id']);
            $table->dropColumn(['service_type', 'event_type_id']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['event_type_id']);
            $table->dropColumn(['service_type', 'event_type_id']);
        });
    }
};

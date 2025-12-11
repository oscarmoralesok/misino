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
        $tables = ['clients', 'events', 'products', 'transactions', 'event_types', 'categories', 'quotes'];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (Schema::hasColumn($tableName, 'user_id')) {
                        // Drop FK first. Naming convention is usually table_user_id_foreign
                        // We can use array syntax to let Laravel guess it, or catch exception if not exists
                         try {
                            $table->dropForeign([ 'user_id' ]);
                        } catch (\Exception $e) {
                            // Foreign key might not exist or verify name
                        }
                        $table->dropColumn('user_id');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We cannot easily restore data, but we can restore the column
        $tables = ['clients', 'events', 'products', 'transactions', 'event_types', 'categories', 'quotes'];

        foreach ($tables as $tableName) {
             if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    if (!Schema::hasColumn($tableName, 'user_id')) {
                        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                    }
                });
             }
        }
    }
};

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
        Schema::table('payments', function (Blueprint $table) {
            // Add session_id column if it doesn't exist
            if (!Schema::hasColumn('payments', 'session_id')) {
                $table->string('session_id')->nullable();
            }

            // Add total_price column if it doesn't exist
            if (!Schema::hasColumn('payments', 'total_price')) {
                $table->decimal('total_price', 10, 2)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop session_id and total_price columns if they exist
            if (Schema::hasColumn('payments', 'session_id')) {
                $table->dropColumn('session_id');
            }

            if (Schema::hasColumn('payments', 'total_price')) {
                $table->dropColumn('total_price');
            }
        });
    }
};

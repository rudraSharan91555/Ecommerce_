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
            // Check if the 'session_id' column exists first, to avoid the "column already exists" error
            if (!Schema::hasColumn('payments', 'session_id')) {
                $table->string('session_id')->nullable();
            }

            // Check if the 'total_price' column exists first
            if (!Schema::hasColumn('payments', 'total_price')) {
                $table->decimal('total_price', 10, 2)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop columns if they exist
            if (Schema::hasColumn('payments', 'session_id')) {
                $table->dropColumn('session_id');
            }

            if (Schema::hasColumn('payments', 'total_price')) {
                $table->dropColumn('total_price');
            }
        });
    }
};

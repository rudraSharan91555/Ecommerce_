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
            // Add column only if it does not already exist
            if (!Schema::hasColumn('payments', 'session_id')) {
                $table->string('session_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'razorpay_payment_id')) {
                $table->string('razorpay_payment_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'razorpay_order_id')) {
                $table->string('razorpay_order_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'razorpay_signature')) {
                $table->string('razorpay_signature')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Dropping Razorpay specific fields
            $table->dropColumn('session_id');
            $table->dropColumn('razorpay_payment_id');
            $table->dropColumn('razorpay_order_id');
            $table->dropColumn('razorpay_signature');
        });
    }
};
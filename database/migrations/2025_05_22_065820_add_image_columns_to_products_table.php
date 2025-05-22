<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 2000)->nullable()->after('slug');
            $table->string('image_mime')->nullable()->after('image');
            $table->integer('image_size')->nullable()->after('image_mime');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image', 'image_mime', 'image_size']);
        });
    }
};

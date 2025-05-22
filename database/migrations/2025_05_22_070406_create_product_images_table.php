
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Create the product_images table
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->string('mime')->nullable();
            $table->integer('size')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        // Step 2: Move data from products to product_images if columns exist
        if (Schema::hasColumns('products', ['image', 'image_mime', 'image_size'])) {
            DB::table('products')
                ->select('id', 'image', 'image_mime', 'image_size')
                ->chunkById(100, function (Collection $products) {
                    $insertData = $products->map(function ($p) {
                        return [
                            'product_id' => $p->id,
                            'path' => null,
                            'url' => $p->image,
                            'mime' => $p->image_mime,
                            'size' => $p->image_size,
                            'position' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    })->filter(fn($item) => $item['url'] !== null);

                    if ($insertData->isNotEmpty()) {
                        DB::table('product_images')->insert($insertData->all());
                    }
                });

            // Step 3: Drop old columns from products
            Schema::table('products', function (Blueprint $table) {
                if (Schema::hasColumn('products', 'image')) {
                    $table->dropColumn('image');
                }
                if (Schema::hasColumn('products', 'image_mime')) {
                    $table->dropColumn('image_mime');
                }
                if (Schema::hasColumn('products', 'image_size')) {
                    $table->dropColumn('image_size');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 2000)->nullable()->after('slug');
            $table->string('image_mime')->nullable()->after('image');
            $table->integer('image_size')->nullable()->after('image_mime');
        });

        Schema::dropIfExists('product_images');
    }
};


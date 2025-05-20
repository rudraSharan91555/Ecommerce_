<?php

use Illuminate\Support\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('path', 255)->nullable();   // nullable bana diya
            $table->string('url', 255);
            $table->string('mime', 55)->nullable();    // nullable bana diya
            $table->integer('size')->default(0);       // default value di
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        DB::table('products')
            ->chunkById(100, function (Collection $products) {
                $products = $products->map(function ($p) {
                    // Agar url ya mime missing ho to skip karenge taaki error na aaye
                    if (empty($p->image) || empty($p->image_mime)) {
                        return null;
                    }
                    return [
                        'product_id' => $p->id,
                        'path' => null,  // path nullable hai
                        'url' => $p->image,
                        'mime' => $p->image_mime,
                        'size' => $p->image_size ?? 0,
                        'position' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                })->filter();  // null values hata di

                DB::table('product_images')->insert($products->all());
            });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('image_mime');
            $table->dropColumn('image_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image', 2000)->nullable()->after('slug');
            $table->string('image_mime')->nullable()->after('image');
            $table->integer('image_size')->nullable()->after('image_mime');
        });

        DB::table('products')
            ->select('id')
            ->chunkById(100, function (Collection $products) {
                foreach ($products as $product) {
                    $image = DB::table('product_images')
                        ->select(['product_id', 'url', 'mime', 'size'])
                        ->where('product_id', $product->id)
                        ->first();
                    if ($image) {
                        DB::table('products')
                            ->where('id', $image->product_id)
                            ->update([
                                'image' => $image->url,
                                'image_mime' => $image->mime,
                                'image_size' => $image->size
                            ]);
                    }
                }
            });

        Schema::dropIfExists('product_images');
    }
};

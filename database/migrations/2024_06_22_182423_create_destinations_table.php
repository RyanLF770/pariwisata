<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Menyimpan path gambar
            $table->string('title', 255);
            $table->decimal('price', 8, 2); // Menyimpan harga dengan 8 digit dan 2 desimal
            $table->text('description'); // Menyimpan deskripsi
            $table->timestamps(); // Menyimpan created_at dan updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};

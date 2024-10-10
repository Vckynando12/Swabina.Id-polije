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
        Schema::create('foto_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_direksi_1')->nullable();
            $table->string('gambar_direksi_2')->nullable();
            $table->string('jejak_langkah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_layanans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('koleksi_pita', function (Blueprint $table) {
            $table->id();
            $table->string('kode_koleksi', 30)->unique();
            $table->string('nama_koleksi', 150);
            $table->foreignId('kategori_format_id')
                ->constrained('kategori_format')
                ->restrictOnDelete();
            $table->year('tahun')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->index('nama_koleksi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koleksi_pita');
    }
};

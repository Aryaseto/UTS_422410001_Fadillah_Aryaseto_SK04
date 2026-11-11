<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_kondisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koleksi_pita_id')
                ->unique()
                ->constrained('koleksi_pita')
                ->cascadeOnDelete();
            $table->text('kondisi_awal');
            $table->enum('tingkat_kerusakan', ['ringan', 'sedang', 'berat']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_kondisi');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('koleksi_tindakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koleksi_pita_id')
                ->constrained('koleksi_pita')
                ->cascadeOnDelete();
            $table->foreignId('tindakan_restorasi_id')
                ->constrained('tindakan_restorasi')
                ->cascadeOnDelete();
            $table->enum('status', ['rencana', 'proses', 'selesai'])->default('rencana');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['koleksi_pita_id', 'tindakan_restorasi_id'], 'koleksi_tindakan_unik');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koleksi_tindakan');
    }
};

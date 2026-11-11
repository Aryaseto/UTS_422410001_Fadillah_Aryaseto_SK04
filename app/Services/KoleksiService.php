<?php

namespace App\Services;

use App\Models\KoleksiPita;
use Illuminate\Support\Facades\DB;

class KoleksiService
{
    /**
     * Menyimpan koleksi, detail kondisi, dan pivot tindakan dalam satu transaksi.
     */
    public function create(array $data): KoleksiPita
    {
        return DB::transaction(function () use ($data) {
            $koleksi = KoleksiPita::create([
                'kode_koleksi' => $data['kode_koleksi'],
                'nama_koleksi' => $data['nama_koleksi'],
                'kategori_format_id' => $data['kategori_format_id'],
                'tahun' => $data['tahun'] ?? null,
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);

            $koleksi->detailKondisi()->create($data['detail']);
            $this->sinkronkanTindakan($koleksi, $data['tindakan'] ?? []);

            return $koleksi->fresh(['kategoriFormat', 'detailKondisi', 'tindakanRestorasi']);
        });
    }

    /**
     * Memperbarui koleksi beserta detail dan pivot tindakan secara atomik.
     */
    public function update(KoleksiPita $koleksi, array $data): KoleksiPita
    {
        return DB::transaction(function () use ($koleksi, $data) {
            $koleksi->update([
                'kode_koleksi' => $data['kode_koleksi'],
                'nama_koleksi' => $data['nama_koleksi'],
                'kategori_format_id' => $data['kategori_format_id'],
                'tahun' => $data['tahun'] ?? null,
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);

            $koleksi->detailKondisi()->updateOrCreate(
                ['koleksi_pita_id' => $koleksi->id],
                $data['detail']
            );

            $this->sinkronkanTindakan($koleksi, $data['tindakan'] ?? []);

            return $koleksi->fresh(['kategoriFormat', 'detailKondisi', 'tindakanRestorasi']);
        });
    }

    public function delete(KoleksiPita $koleksi): void
    {
        DB::transaction(function () use ($koleksi) {
            $koleksi->tindakanRestorasi()->detach();
            $koleksi->detailKondisi()->delete();
            $koleksi->delete();
        });
    }

    /**
     * @param  array<int|string, array<string, mixed>>  $tindakan
     */
    private function sinkronkanTindakan(KoleksiPita $koleksi, array $tindakan): void
    {
        $pivot = collect($tindakan)
            ->filter(fn ($baris) => is_array($baris) && ! empty($baris['dipilih']))
            ->mapWithKeys(fn (array $baris, int|string $id) => [
                (int) $id => [
                    'status' => $baris['status'] ?? 'rencana',
                    'tanggal_mulai' => filled($baris['tanggal_mulai'] ?? null) ? $baris['tanggal_mulai'] : null,
                    'tanggal_selesai' => filled($baris['tanggal_selesai'] ?? null) ? $baris['tanggal_selesai'] : null,
                    'catatan' => filled($baris['catatan'] ?? null) ? $baris['catatan'] : null,
                ],
            ])
            ->all();

        $koleksi->tindakanRestorasi()->sync($pivot);
    }
}

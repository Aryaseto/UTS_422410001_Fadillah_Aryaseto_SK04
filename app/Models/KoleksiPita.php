<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KoleksiPita extends Model
{
    use HasFactory;

    protected $table = 'koleksi_pita';

    public const TINGKAT_KERUSAKAN = [
        'ringan' => 'Ringan',
        'sedang' => 'Sedang',
        'berat' => 'Berat',
    ];

    public const STATUS_TINDAKAN = [
        'rencana' => 'Rencana',
        'proses' => 'Proses',
        'selesai' => 'Selesai',
    ];

    protected $fillable = [
        'kode_koleksi',
        'nama_koleksi',
        'kategori_format_id',
        'tahun',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
        ];
    }

    public function kategoriFormat(): BelongsTo
    {
        return $this->belongsTo(KategoriFormat::class, 'kategori_format_id');
    }

    public function detailKondisi(): HasOne
    {
        return $this->hasOne(DetailKondisi::class, 'koleksi_pita_id');
    }

    public function tindakanRestorasi(): BelongsToMany
    {
        return $this->belongsToMany(
            TindakanRestorasi::class,
            'koleksi_tindakan',
            'koleksi_pita_id',
            'tindakan_restorasi_id'
        )
            ->withPivot([
                'id',
                'status',
                'tanggal_mulai',
                'tanggal_selesai',
                'catatan',
            ])
            ->withTimestamps();
    }

    public function scopeCari(Builder $query, ?string $kataKunci): Builder
    {
        $kataKunci = trim((string) $kataKunci);

        if ($kataKunci === '') {
            return $query;
        }

        return $query->where(function (Builder $query) use ($kataKunci) {
            $query
                ->where('kode_koleksi', 'like', "%{$kataKunci}%")
                ->orWhere('nama_koleksi', 'like', "%{$kataKunci}%");
        });
    }

    public function scopeFilterKategori(Builder $query, mixed $kategoriId): Builder
    {
        return $query->when(
            filled($kategoriId),
            fn (Builder $query) => $query->where('kategori_format_id', $kategoriId)
        );
    }

    public function scopeFilterTingkat(Builder $query, ?string $tingkat): Builder
    {
        return $query->when(
            filled($tingkat) && array_key_exists($tingkat, self::TINGKAT_KERUSAKAN),
            fn (Builder $query) => $query->whereHas(
                'detailKondisi',
                fn (Builder $query) => $query->where('tingkat_kerusakan', $tingkat)
            )
        );
    }

    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when(
            filled($status) && array_key_exists($status, self::STATUS_TINDAKAN),
            fn (Builder $query) => $query->whereHas(
                'tindakanRestorasi',
                fn (Builder $query) => $query->where('koleksi_tindakan.status', $status)
            )
        );
    }

    public function labelTahun(): string
    {
        return $this->tahun ? (string) $this->tahun : 'Tahun tidak tercatat';
    }

    public function statusDominan(): string
    {
        $status = $this->tindakanRestorasi->pluck('pivot.status');

        if ($status->isEmpty()) {
            return 'belum';
        }

        if ($status->every(fn (string $item) => $item === 'selesai')) {
            return 'selesai';
        }

        if ($status->contains('proses')) {
            return 'proses';
        }

        if ($status->contains('rencana')) {
            return 'rencana';
        }

        return 'belum';
    }
}

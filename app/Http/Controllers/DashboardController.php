<?php

namespace App\Http\Controllers;

use App\Models\DetailKondisi;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statistik = [
            'koleksi' => KoleksiPita::query()->count(),
            'kategori' => KategoriFormat::query()->count(),
            'tindakan' => TindakanRestorasi::query()->count(),
            'berat' => DetailKondisi::query()->where('tingkat_kerusakan', 'berat')->count(),
        ];

        $kondisi = DetailKondisi::query()
            ->selectRaw('tingkat_kerusakan, COUNT(*) as total')
            ->groupBy('tingkat_kerusakan')
            ->pluck('total', 'tingkat_kerusakan');

        $statusTindakan = DB::table('koleksi_tindakan')
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalPivot = $statusTindakan->sum();
        $persentaseSelesai = $totalPivot > 0
            ? (int) round(($statusTindakan->get('selesai', 0) / $totalPivot) * 100)
            : 0;

        $koleksiTerbaru = KoleksiPita::query()
            ->with(['kategoriFormat', 'detailKondisi'])
            ->withCount('tindakanRestorasi')
            ->latest()
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $prioritasBerat = KoleksiPita::query()
            ->with(['kategoriFormat', 'detailKondisi'])
            ->whereHas('detailKondisi', fn ($query) => $query->where('tingkat_kerusakan', 'berat'))
            ->latest()
            ->orderByDesc('id')
            ->take(4)
            ->get();

        $antreanProses = KoleksiPita::query()
            ->with(['kategoriFormat', 'detailKondisi', 'tindakanRestorasi'])
            ->whereHas('tindakanRestorasi', fn ($query) => $query->where('koleksi_tindakan.status', 'proses'))
            ->latest()
            ->orderByDesc('id')
            ->take(4)
            ->get();

        $distribusi = KategoriFormat::query()
            ->withCount('koleksiPita')
            ->orderByDesc('koleksi_pita_count')
            ->orderBy('nama_format')
            ->take(6)
            ->get();

        $maksDistribusi = max(1, (int) $distribusi->max('koleksi_pita_count'));

        return view('dashboard', compact(
            'statistik',
            'kondisi',
            'statusTindakan',
            'totalPivot',
            'persentaseSelesai',
            'koleksiTerbaru',
            'prioritasBerat',
            'antreanProses',
            'distribusi',
            'maksDistribusi',
        ));
    }
}

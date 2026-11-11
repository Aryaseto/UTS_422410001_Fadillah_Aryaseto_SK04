<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKoleksiRequest;
use App\Http\Requests\UpdateKoleksiRequest;
use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use App\Services\KoleksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KoleksiController extends Controller
{
    public function __construct(private readonly KoleksiService $koleksiService) {}

    public function index(Request $request): View
    {
        $filter = [
            'q' => trim((string) $request->query('q')),
            'kategori' => $request->query('kategori'),
            'tingkat' => $request->query('tingkat'),
            'status' => $request->query('status'),
        ];

        $koleksi = KoleksiPita::query()
            ->with(['kategoriFormat', 'detailKondisi'])
            ->withCount([
                'tindakanRestorasi as total_tindakan',
                'tindakanRestorasi as total_rencana' => fn ($query) => $query->where('koleksi_tindakan.status', 'rencana'),
                'tindakanRestorasi as total_proses' => fn ($query) => $query->where('koleksi_tindakan.status', 'proses'),
                'tindakanRestorasi as total_selesai' => fn ($query) => $query->where('koleksi_tindakan.status', 'selesai'),
            ])
            ->cari($filter['q'])
            ->filterKategori($filter['kategori'])
            ->filterTingkat($filter['tingkat'])
            ->filterStatus($filter['status'])
            ->latest()
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $kategori = KategoriFormat::query()->orderBy('nama_format')->get();
        $adaFilter = filled($filter['q']) || filled($filter['kategori']) || filled($filter['tingkat']) || filled($filter['status']);
        $tingkatOptions = KoleksiPita::TINGKAT_KERUSAKAN;
        $statusOptions = KoleksiPita::STATUS_TINDAKAN;

        return view('koleksi.index', compact('koleksi', 'kategori', 'filter', 'adaFilter', 'tingkatOptions', 'statusOptions'));
    }

    public function create(): View
    {
        return view('koleksi.create', [
            'kategori' => KategoriFormat::query()->orderBy('nama_format')->get(),
            'tindakan' => TindakanRestorasi::query()->orderBy('nama_tindakan')->get(),
            'koleksi' => new KoleksiPita,
        ]);
    }

    public function store(StoreKoleksiRequest $request): RedirectResponse
    {
        $koleksi = $this->koleksiService->create($request->validated());

        return redirect()
            ->route('koleksi.show', $koleksi)
            ->with('success', "Koleksi {$koleksi->kode_koleksi} berhasil dicatat beserta detail kondisi dan tindakan restorasinya.");
    }

    public function show(KoleksiPita $koleksi): View
    {
        $koleksi->load([
            'kategoriFormat',
            'detailKondisi',
            'tindakanRestorasi' => fn ($query) => $query->orderBy('nama_tindakan'),
        ]);

        $urutanStatus = ['proses' => 0, 'rencana' => 1, 'selesai' => 2];
        $daftarTindakan = $koleksi->tindakanRestorasi
            ->sortBy(fn ($tindakan) => sprintf(
                '%d-%s',
                $urutanStatus[$tindakan->pivot->status] ?? 3,
                $tindakan->nama_tindakan
            ))
            ->values();

        return view('koleksi.show', compact('koleksi', 'daftarTindakan'));
    }

    public function edit(KoleksiPita $koleksi): View
    {
        $koleksi->load(['detailKondisi', 'tindakanRestorasi']);

        return view('koleksi.edit', [
            'koleksi' => $koleksi,
            'kategori' => KategoriFormat::query()->orderBy('nama_format')->get(),
            'tindakan' => TindakanRestorasi::query()->orderBy('nama_tindakan')->get(),
        ]);
    }

    public function update(UpdateKoleksiRequest $request, KoleksiPita $koleksi): RedirectResponse
    {
        $koleksi = $this->koleksiService->update($koleksi, $request->validated());

        return redirect()
            ->route('koleksi.show', $koleksi)
            ->with('success', "Data koleksi {$koleksi->kode_koleksi} berhasil diperbarui.");
    }

    public function destroy(KoleksiPita $koleksi): RedirectResponse
    {
        $kode = $koleksi->kode_koleksi;
        $this->koleksiService->delete($koleksi);

        return redirect()
            ->route('koleksi.index')
            ->with('success', "Koleksi {$kode} beserta detail dan tindakannya telah dihapus.");
    }
}

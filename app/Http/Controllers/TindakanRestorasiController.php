<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTindakanRequest;
use App\Http\Requests\UpdateTindakanRequest;
use App\Models\TindakanRestorasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TindakanRestorasiController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));

        $tindakan = TindakanRestorasi::query()
            ->withCount('koleksiPita')
            ->when($q !== '', fn ($query) => $query->where('nama_tindakan', 'like', "%{$q}%"))
            ->orderBy('nama_tindakan')
            ->paginate(10)
            ->withQueryString();

        return view('tindakan.index', compact('tindakan', 'q'));
    }

    public function create(): View
    {
        return view('tindakan.create', ['tindakanRestorasi' => new TindakanRestorasi]);
    }

    public function store(StoreTindakanRequest $request): RedirectResponse
    {
        $tindakan = TindakanRestorasi::create($request->validated());

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan {$tindakan->nama_tindakan} berhasil ditambahkan.");
    }

    public function show(string $id): RedirectResponse
    {
        return redirect()->route('tindakan.index');
    }

    public function edit(TindakanRestorasi $tindakanRestorasi): View
    {
        return view('tindakan.edit', compact('tindakanRestorasi'));
    }

    public function update(UpdateTindakanRequest $request, TindakanRestorasi $tindakanRestorasi): RedirectResponse
    {
        $tindakanRestorasi->update($request->validated());

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan {$tindakanRestorasi->nama_tindakan} berhasil diperbarui.");
    }

    public function destroy(TindakanRestorasi $tindakanRestorasi): RedirectResponse
    {
        if ($tindakanRestorasi->koleksiPita()->exists()) {
            return redirect()
                ->route('tindakan.index')
                ->with('error', "Tindakan {$tindakanRestorasi->nama_tindakan} masih terpasang pada koleksi. Lepaskan dari koleksi terlebih dahulu.");
        }

        $nama = $tindakanRestorasi->nama_tindakan;
        $tindakanRestorasi->delete();

        return redirect()
            ->route('tindakan.index')
            ->with('success', "Tindakan {$nama} berhasil dihapus.");
    }
}

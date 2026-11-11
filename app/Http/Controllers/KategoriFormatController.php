<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\KategoriFormat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriFormatController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));

        $kategori = KategoriFormat::query()
            ->withCount('koleksiPita')
            ->when($q !== '', fn ($query) => $query->where('nama_format', 'like', "%{$q}%"))
            ->orderBy('nama_format')
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('kategori', 'q'));
    }

    public function create(): View
    {
        return view('kategori.create', ['kategoriFormat' => new KategoriFormat]);
    }

    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $kategori = KategoriFormat::create($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format {$kategori->nama_format} berhasil ditambahkan.");
    }

    public function show(string $id): RedirectResponse
    {
        return redirect()->route('kategori.index');
    }

    public function edit(KategoriFormat $kategoriFormat): View
    {
        return view('kategori.edit', compact('kategoriFormat'));
    }

    public function update(UpdateKategoriRequest $request, KategoriFormat $kategoriFormat): RedirectResponse
    {
        $kategoriFormat->update($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format {$kategoriFormat->nama_format} berhasil diperbarui.");
    }

    public function destroy(KategoriFormat $kategoriFormat): RedirectResponse
    {
        if ($kategoriFormat->koleksiPita()->exists()) {
            return redirect()
                ->route('kategori.index')
                ->with('error', "Kategori {$kategoriFormat->nama_format} masih dipakai oleh koleksi lain. Pindahkan koleksi tersebut terlebih dahulu.");
        }

        $nama = $kategoriFormat->nama_format;
        $kategoriFormat->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', "Kategori format {$nama} berhasil dihapus.");
    }
}

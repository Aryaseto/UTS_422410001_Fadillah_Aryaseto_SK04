<?php

namespace App\Http\Requests;

use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

abstract class KoleksiRequest extends FormRequest
{
    abstract protected function koleksiPita(): ?KoleksiPita;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'kode_koleksi' => strtoupper(trim((string) $this->input('kode_koleksi'))),
            'nama_koleksi' => trim((string) $this->input('nama_koleksi')),
        ]);
    }

    public function rules(): array
    {
        $koleksi = $this->koleksiPita();

        return [
            'kode_koleksi' => [
                'required',
                'string',
                'max:30',
                Rule::unique('koleksi_pita', 'kode_koleksi')->ignore($koleksi?->id),
            ],
            'nama_koleksi' => ['required', 'string', 'max:150'],
            'kategori_format_id' => ['required', 'integer', 'exists:kategori_format,id'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:'.(now()->year + 1)],
            'deskripsi' => ['nullable', 'string', 'max:3000'],
            'detail.kondisi_awal' => ['required', 'string', 'max:5000'],
            'detail.tingkat_kerusakan' => ['required', Rule::in(array_keys(KoleksiPita::TINGKAT_KERUSAKAN))],
            'detail.catatan' => ['nullable', 'string', 'max:2000'],
            'tindakan' => ['nullable', 'array'],
            'tindakan.*.dipilih' => ['nullable', 'boolean'],
            'tindakan.*.status' => ['nullable', Rule::in(array_keys(KoleksiPita::STATUS_TINDAKAN))],
            'tindakan.*.tanggal_mulai' => ['nullable', 'date'],
            'tindakan.*.tanggal_selesai' => ['nullable', 'date'],
            'tindakan.*.catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $tindakan = $this->input('tindakan', []);

                if (! is_array($tindakan)) {
                    return;
                }

                $ids = array_keys($tindakan);
                $jumlahValid = TindakanRestorasi::query()->whereIn('id', $ids)->count();

                if ($jumlahValid !== count($ids)) {
                    $validator->errors()->add('tindakan', 'Ada tindakan restorasi yang tidak dikenal. Muat ulang halaman lalu coba lagi.');
                }

                foreach ($tindakan as $id => $baris) {
                    if (! is_array($baris) || empty($baris['dipilih'])) {
                        continue;
                    }

                    $status = $baris['status'] ?? null;
                    $mulai = $baris['tanggal_mulai'] ?? null;
                    $selesai = $baris['tanggal_selesai'] ?? null;

                    if (blank($status)) {
                        $validator->errors()->add("tindakan.{$id}.status", 'Status wajib dipilih untuk tindakan yang dicentang.');

                        continue;
                    }

                    if (in_array($status, ['proses', 'selesai'], true) && blank($mulai)) {
                        $validator->errors()->add("tindakan.{$id}.tanggal_mulai", 'Tanggal mulai wajib diisi untuk status proses atau selesai.');
                    }

                    if ($status === 'selesai' && blank($selesai)) {
                        $validator->errors()->add("tindakan.{$id}.tanggal_selesai", 'Tanggal selesai wajib diisi untuk status selesai.');
                    }

                    if (filled($mulai) && filled($selesai)) {
                        $mulaiTs = strtotime((string) $mulai);
                        $selesaiTs = strtotime((string) $selesai);

                        if ($mulaiTs !== false && $selesaiTs !== false && $selesaiTs < $mulaiTs) {
                            $validator->errors()->add("tindakan.{$id}.tanggal_selesai", 'Tanggal selesai tidak boleh sebelum tanggal mulai.');
                        }
                    }
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'kode_koleksi.unique' => 'Kode koleksi ini sudah dipakai. Gunakan kode lain.',
            'kategori_format_id.exists' => 'Kategori format yang dipilih tidak tersedia.',
            'detail.kondisi_awal.required' => 'Kondisi awal wajib dijelaskan.',
            'detail.tingkat_kerusakan.required' => 'Tingkat kerusakan wajib dipilih.',
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_koleksi' => 'kode koleksi',
            'nama_koleksi' => 'nama koleksi',
            'kategori_format_id' => 'kategori format',
            'tahun' => 'tahun',
            'deskripsi' => 'deskripsi',
            'detail.kondisi_awal' => 'kondisi awal',
            'detail.tingkat_kerusakan' => 'tingkat kerusakan',
            'detail.catatan' => 'catatan kondisi',
        ];
    }
}

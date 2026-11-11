<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_format' => trim((string) $this->input('nama_format')),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_format' => ['required', 'string', 'max:100', Rule::unique('kategori_format', 'nama_format')],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_format.unique' => 'Nama format ini sudah terdaftar.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_format' => 'nama format',
            'deskripsi' => 'deskripsi',
        ];
    }
}

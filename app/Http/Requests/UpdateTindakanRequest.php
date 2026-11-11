<?php

namespace App\Http\Requests;

use App\Models\TindakanRestorasi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTindakanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_tindakan' => trim((string) $this->input('nama_tindakan')),
        ]);
    }

    public function rules(): array
    {
        $tindakan = $this->route('tindakanRestorasi');

        return [
            'nama_tindakan' => [
                'required',
                'string',
                'max:120',
                Rule::unique('tindakan_restorasi', 'nama_tindakan')
                    ->ignore($tindakan instanceof TindakanRestorasi ? $tindakan->id : null),
            ],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_tindakan.unique' => 'Nama tindakan ini sudah terdaftar.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_tindakan' => 'nama tindakan',
            'deskripsi' => 'deskripsi',
        ];
    }
}

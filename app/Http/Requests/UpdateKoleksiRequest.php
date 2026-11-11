<?php

namespace App\Http\Requests;

use App\Models\KoleksiPita;

class UpdateKoleksiRequest extends KoleksiRequest
{
    protected function koleksiPita(): ?KoleksiPita
    {
        $koleksi = $this->route('koleksi');

        return $koleksi instanceof KoleksiPita ? $koleksi : null;
    }
}

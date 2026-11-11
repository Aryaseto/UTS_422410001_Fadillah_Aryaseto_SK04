<?php

namespace App\Http\Requests;

use App\Models\KoleksiPita;

class StoreKoleksiRequest extends KoleksiRequest
{
    protected function koleksiPita(): ?KoleksiPita
    {
        return null;
    }
}

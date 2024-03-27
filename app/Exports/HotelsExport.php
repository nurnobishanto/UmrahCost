<?php

namespace App\Exports;

use App\Models\Hotel;
use Maatwebsite\Excel\Concerns\FromCollection;

class HotelsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hotel::select('id', 'name')->get();
    }
}

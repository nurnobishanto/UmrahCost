<?php

namespace App\Exports;

use App\Models\RoomType;
use Maatwebsite\Excel\Concerns\FromCollection;

class RoomTypesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RoomType::all();
    }
}

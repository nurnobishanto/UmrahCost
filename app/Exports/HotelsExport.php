<?php

namespace App\Exports;

use App\Models\Hotel;
use Maatwebsite\Excel\Concerns\FromCollection;

class HotelsExport implements FromCollection
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection(): \Illuminate\Support\Collection
    {
        return Hotel::select('id', 'name')->where('location_id',$this->id)->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Hotel Name',
        ];
    }
}

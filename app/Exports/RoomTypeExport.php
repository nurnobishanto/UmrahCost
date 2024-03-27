<?php

namespace App\Exports;

use App\Models\RoomType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomTypeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return RoomType::select('hotel_id','name','nos_of_traveler','cost_per_day','status','from_date','to_date')->get();
    }

    public function headings(): array
    {
        return [
            'hotel_id',
            'name',
            'nos_of_traveler',
            'cost_per_day',
            'status',
            'from_date',
            'to_date',
        ];
    }
}

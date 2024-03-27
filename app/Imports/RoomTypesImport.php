<?php

namespace App\Imports;

use App\Models\RoomType;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class RoomTypesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required',
            'nos_of_traveler' => 'required',
            'cost_per_day' => 'required',
            'status' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',

        ]);

        if ($validator->fails()) {
            // Handle validation failure (e.g., log errors, skip row, etc.)
            // For example, you can log errors and return null to skip the row:
            \Log::error('Validation failed for row: ' . json_encode($row));
            dd($validator->errors()->all());
            return null;
        }
        return new RoomType([
            'hotel_id'     => $row['hotel_id'],
            'name'     => $row['name'],
            'nos_of_traveler'     => $row['nos_of_traveler'],
            'cost_per_day'     => $row['cost_per_day'],
            'status'     => $row['status'],
            'from_date'     => $row['from_date'],
            'to_date'     => $row['to_date'],
        ]);
    }
}

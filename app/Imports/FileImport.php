<?php

namespace App\Imports;

use App\Models\ClientImportFile;
use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct($values, $project_type)
    {
        $this->values = $values;
        $this->project_type = $project_type;
    }

    public function model(array $row)
    {
        $file_no    = null;
        $batch_no   = null;
        $box_no     = null;
        if(isset($row['file_no'])) $file_no = $row['file_no']; else if(isset($row['batch_no'])) {$batch_no = $row['batch_no']; $box_no = $row['box_no'];} else if(isset($row['box_no'])) $box_no = $row['box_no'];

        return new ClientImportFile([
            'file_no'           => $file_no,
            'batch_no'          => $batch_no,
            'box_no'            => $box_no,
            'r1'                => $row['r1'] ?? null,
            'r2'                => $row['r2'] ?? null,
            'r3'                => $row['r3'] ?? null,
            'type'              => $this->project_type,
            //'type'              => dynamic,
            'upload'            => 'Imported',
            'client_import_id'  => $this->values['id'],
        ]);
    }
}

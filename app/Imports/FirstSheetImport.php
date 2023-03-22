<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FirstSheetImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // dump($row);
        return new Item([
            'description' => $row[0],
            'cost_price' => $row[1],
            'sell_price' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }


}

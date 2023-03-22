<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class itemsImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    // public function model(array $row)
    // {
    //     // dump($row);
    //     return new Item([
    //         'description' => $row[0],
    //         'cost_price' => $row[1],
    //         'sell_price' => $row[2],
    //     ]);
    // }

    public function sheets(): array
    {
        return [
            // 0 => new FirstSheetImport(),
             'item' => new FirstSheetImport(),
             'item2' => new SecondSheetImport(),

           
        ];
    }
}

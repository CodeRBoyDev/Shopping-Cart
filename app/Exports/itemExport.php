<?php

namespace App\Exports;
use App\Models\Item;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class itemExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::all();
    }
}

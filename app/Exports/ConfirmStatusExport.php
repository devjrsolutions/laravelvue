<?php

namespace App\Exports;

use App\Components\Master\Models\ConfirmStatus;
use App\Components\Master\Repositories\ConfirmStatusRepository;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConfirmStatusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ConfirmStatus::all()->get();
    }
}

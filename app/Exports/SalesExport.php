<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $sales)
    {
        $this->sales = $sales;
    }
    public function array(): array
    {
        return $this->sales;
    }

    public function headings(): array
    {
        return ["No",
                "Inventory",
                "Unit Price",
                "Quantity",
                "Price",
               ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
        // Style the first row as bold text.
        1    => ['font' => ['bold' => true]],
        ];
    }
}

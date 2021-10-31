<?php

namespace App\Exports;

use App\Models\Incame;
use App\Services\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
class IncomeExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;
    protected $category;
    public function __construct($start_date, $end_date, $category) {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->category = $category;
    }

    public function headings(): array
    {
        return [
            'id',
            'amount',
            'bayer_name',
            'bayer_phone',
            'incame_date',
            'description'
        ];
    }

    public function collection()
    {        $report = new Report();
        $incomes = $report->incomeReport(
                    $this->start_date,
                    $this->end_date,
                    $this->category);
        return $incomes;
    }
}

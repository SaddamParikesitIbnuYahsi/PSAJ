<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepartureExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function query() {
        return $this->query;
    }

    public function headings(): array {
        return [
            'Nama Jamaah',
            'No. Registrasi',
            'Paket Umroh',
            'Agen/Cabang',
            'Status',
            'Tanggal Keberangkatan (Update)'
        ];
    }

    public function map($data): array {
        return [
            $data->name,
            $data->sku,
            $data->category->name ?? '-',
            $data->supplier->name ?? 'Pusat',
            'TELAH BERANGKAT',
            $data->updated_at->format('d-m-Y H:i'),
        ];
    }
}
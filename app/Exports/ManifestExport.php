<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ManifestExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Jamaah',
            'SKU / No. Reg',
            'Paket',
            'Agen',
            'Biaya (IDR)',
            'Sisa Seat (Pax)',
            'Tanggal Input'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->sku,
            $product->category->name ?? 'N/A',
            $product->supplier->name ?? 'Pusat',
            $product->selling_price,
            $product->current_stock,
            $product->created_at->format('d-m-Y')
        ];
    }
}
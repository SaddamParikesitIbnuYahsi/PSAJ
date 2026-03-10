<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Product::query()
            ->with(['category', 'supplier'])
            ->orderBy('name');

        if ($this->request->filled('search')) {
            $query->where('name', 'like', '%'.$this->request->search.'%');
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Nama Jamaah / Paket',
            'Program Paket',
            'Mitra / Agen',
            'Deskripsi',
            'Harga Beli',
            'Harga Jual',
            'Kuota Seat',
            'Batas Min Kuota',
            'Satuan'
        ];
    }

    public function map($product): array
    {
        return [
            $product->sku,
            $product->name,
            $product->category->name ?? '',
            $product->supplier->name ?? '',
            $product->description,
            $product->purchase_price,
            $product->selling_price,
            $product->current_stock,
            $product->min_stock,
            $product->unit
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

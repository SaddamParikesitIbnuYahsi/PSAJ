<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepartureExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
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
            'ID Transaksi',
            'Tanggal Berangkat',
            'Nama Jamaah',
            'No. Registrasi / Paspor',
            'Paket',
            'Agen',
            'Jumlah Pax',
            'Status',
            'Verifikator',
            'Catatan',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            optional($transaction->date)->format('d-m-Y H:i'),
            optional($transaction->product)->name ?? 'N/A',
            optional($transaction->product)->sku ?? '-',
            optional($transaction->product->category)->name ?? '-',
            optional($transaction->supplier)->name ?? 'Pusat',
            $transaction->quantity,
            $transaction->status,
            optional($transaction->user)->name ?? 'Sistem',
            $transaction->notes ?? '',
        ];
    }
}


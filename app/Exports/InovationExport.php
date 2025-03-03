<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InovationExport implements FromCollection, WithHeadings, WithEvents, WithColumnWidths
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            return collect($item['bukti'])->map(function ($bukti) use ($item) {
                return [
                    'Nama Proposal' => $item['proposal'],
                    'SKPD' => $item['skpd'],
                    'Skor' => $item['skor'],
                    'Tahun' => $item['tahun'],
                    'Bukti' => $bukti['text'],
                    'Download' => $bukti['url'],
                ];
            });
        })->collapse(); // Gabungkan hasil menjadi satu collection
    }

    public function headings(): array
    {
        return ["Nama Proposal", "SKPD", "Skor", "Tahun", "Bukti", "Download"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25, // Nama Proposal
            'B' => 20, // SKPD
            'C' => 10, // Skor
            'D' => 10, // Tahun
            'E' => 40, // Bukti
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Styling untuk header
                $sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'CCCCCC'],
                    ],
                ]);

                // Iterasi data untuk hyperlink
                foreach ($this->data as $index => $item) {
                    $rowIndex = $index + 2;

                    foreach ($item['bukti'] as $b) {
                        $cell = "F$rowIndex";

                        // Set hyperlink dengan teks informasi
                        $sheet->setCellValue($cell, $b['text']);
                        $sheet->getCell($cell)->getHyperlink()->setUrl($b['url']);

                        // Styling warna hijau untuk hyperlink
                        $sheet->getStyle($cell)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '008000'],
                                'underline' => true,
                            ],
                        ]);
                    }
                }
            },
        ];
    }

}


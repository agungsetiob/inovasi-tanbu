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
        $base_url = config('app.url') . '/storage/docs/';
    
        return collect($this->data)->flatMap(function ($item) use ($base_url) {
            $filteredFiles = isset($item['files']) && is_array($item['files'])
                ? collect($item['files'])->filter(function ($file) {
                    return $file['indikator_id'] == 4;
                })
                : collect();
    
            if ($filteredFiles->isEmpty()) {
                return [[
                    'Nama Proposal' => $item['proposal'],
                    'SKPD' => $item['skpd'],
                    'Skor' => $item['skor'],
                    'Tahun' => $item['tahun'],
                    'Bukti' => '',
                    'Jenis' => $item['jenis'],
                    'Bentuk' => $item['bentuk'],
                    'Urusan' => $item['urusans'],
                ]];
            }
            
            return $filteredFiles->map(function ($file) use ($item, $base_url) {
                return [
                    'Nama Proposal' => $item['proposal'],
                    'SKPD' => $item['skpd'],
                    'Skor' => $item['skor'],
                    'Tahun' => $item['tahun'],
                    'Bukti' => $base_url . $file['name'],
                    'Jenis' => $item['jenis'],
                    'Bentuk' => $item['bentuk'],
                    'Urusan' => $item['urusans'],
                ];
            });
        })->values();
    }    
    
    public function headings(): array
    {
        return ["Nama Proposal", "SKPD", "Skor", "Tahun", "Bukti", "Jenis", "Bentuk", "Urusan"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 70, // Nama Proposal
            'B' => 65, // SKPD
            'C' => 10, // Skor
            'D' => 10, // Tahun
            'E' => 40, // Bukti
            'F' => 20, // Jenis
            'G' => 20, // Bentuk
            'H' => 50, // Urusan
        ];
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
    
                $sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'CCCCCC'],
                    ],
                ]);
    
                $sheet->getStyle('A1:H1' . ($sheet->getHighestRow()))->getAlignment()->setWrapText(true);
    
                foreach ($this->data as $index => $item) {
                    $rowIndex = $index + 2;
    
                    if (!empty($item['Bukti'])) {
                        $cell = "E{$rowIndex}";
    
                        $sheet->setCellValue($cell, 'Download');
                        $sheet->getCell($cell)->getHyperlink()->setUrl($item['Bukti']);
    
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
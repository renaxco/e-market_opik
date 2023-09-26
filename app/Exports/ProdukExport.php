<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class ProdukExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    public function collection()
    {
        return Produk::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(5);  //no
                $event->sheet->getColumnDimension('B')->setAutoSize(true); //nama produk
                $event->sheet->getColumnDimension('C')->setAutoSize(true); //created at
                $event->sheet->getColumnDimension('D')->setAutoSize(true); //updated

                // judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->setCellValue('A1', "DATA PRODUK DI MARKET");
                $event->sheet->setCellValue('A2', "PER TANGGAL ".date('d M Y'));

                //style 
                $event->sheet->getStyle('A4:D4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                //Color
                $styleArray = [
                        'font' => [
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'rotation' => 90,
                            'color' => [
                                'argb' => 'FFA0A0A0',
                            ],
                        ],
                    ];

                $event->sheet->getStyle('A4:D4')->applyFromArray($styleArray);
                //Border
                $event->sheet->getStyle('A4:D' . $event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ]
                ]);
            }
        ];
    }
    public function headings():array{
        return [
            'No.',
            'Nama Produk',
            'Created At',
            'Updated At'
        ];
    }

    public function title(): string
    {
        return 'Data';
    }
}

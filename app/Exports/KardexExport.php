<?php

namespace App\Exports;

use App\Models\Kardexdate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KardexExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kardexdate::select('detalle','cantidad_ingreso','cantidad_salida','precio_unitario','saldoingreso','saldototal')->get();   
    }
    public function headings(): array
    {
        return [
            'Detalle',
            'Cantidad Ingreso',
            'Cantidad Salida',
            'Precio Unitario',
            'Saldo Ingreso',
            'Saldo Total'
        ];
    }

    
    public function styles(Worksheet $sheet)
    {
        
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFE699'], // Fondo amarillo claro
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        
        $lastRow = $sheet->getHighestRow(); // Obtiene el número de la última fila con datos
        $sheet->getStyle("A2:F$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return [];
    }

}

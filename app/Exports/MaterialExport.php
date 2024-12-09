<?php
namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaterialExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    // Retorna los datos que se exportarán
    public function collection()
    {
        return Material::select('codigo_material', 'nombre', 'unidad')->get();
    }

    // Define los encabezados de las columnas
    public function headings(): array
    {
        return [
            'Código del Material',
            'Nombre del Material',
            'Unidad',
        ];
    }

    // Aplica estilos personalizados
    public function styles(Worksheet $sheet)
    {
        // Aplicar estilos a los encabezados
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFE699'], 
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        
        $lastRow = $sheet->getHighestRow(); 
        $sheet->getStyle("A2:C$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return [];
    }
}

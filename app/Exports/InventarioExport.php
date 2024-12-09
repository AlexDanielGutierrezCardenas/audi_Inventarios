<?php

namespace App\Exports;

use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventario::select('nombrematerial', 'cantidad', 'unidadmedida', 'preciounitario', 'preciototal')->get();
    }
     
     public function headings(): array
     {
         return [
             'Nombre del Material',
             'Cantidad',
             'Unidad de Medida',
             'Precio Unitario',
             'Precio Total',
         ];
     }
 

     public function styles(Worksheet $sheet)
     {
        
         $sheet->getStyle('A1:E1')->applyFromArray([
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
         $sheet->getStyle("A2:E$lastRow")->applyFromArray([
             'borders' => [
                 'allBorders' => [
                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                 ],
             ],
         ]);
 
         return [];
     }

}

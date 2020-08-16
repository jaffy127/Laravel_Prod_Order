<?php

namespace App\Exports;

use App\Cliente;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
/*use Maatwebsite\Excel\Concerns\FromCollection;*/
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths; //ancho de columnas
use Maatwebsite\Excel\Concerns\ShouldAutoSize; //auto size de las columnas
use Maatwebsite\Excel\Concerns\WithStyles; // styles a las celdas
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // styles a las celdas
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; //para exportar en view


class ClientesExport implements Responsable, FromView, WithColumnWidths, WithStyles
{
	use Exportable;

	/**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'clientes.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Cliente::all();
    }*/

    public function view(): View
    {
        $objCliente = new Cliente();
        $result_cliente = $objCliente->getInfoCliente();
        //return view('sistema.cliente.tabla_cliente', compact('result_cliente'));
        return view('sistema.cliente.exportacion_tablas.excel_tabla_cliente', compact('result_cliente'));
        
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A2:D2')->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('ffff6b');

        
        $sheet->getStyle('A2:D2')->getFont()->setBold(true);
        $sheet->getStyle('A2:D50')->getAlignment()
                                ->setHorizontal('left')
                                ->setVertical('center')
                                ->setWrapText(true);
        $sheet->getStyle('A3:A50')->getAlignment()
                                ->setHorizontal('left')
                                ->setVertical('center');


        /*return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]],
        ];*/
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 50,  
            'C' => 25,
            'D' => 15          
        ];
    }
}

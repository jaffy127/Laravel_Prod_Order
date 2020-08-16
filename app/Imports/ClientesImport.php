<?php

namespace App\Imports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class ClientesImport implements ToModel, WithHeadingRow, WithValidation, WithStrictNullComparison
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([ 
            "nombre_cliente" => $row['nombre'], //a
            "direccion" => $row['direccion'], //b
            "email" => $row['email'], //c
            "telefono" => $row['telefono'], //d
            "moneda" => $row['moneda'] //f
                        
        ]);
    }

    //validaciones del los campos
    public function rules() : array
    {
        return [
            'nombre' => 'required|string',
            'telefono' => 'regex:/[0-9]{10}/',
            'email' => 'unique:email',
            
        ];
    }
}

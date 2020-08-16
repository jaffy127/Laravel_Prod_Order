<?php

namespace App\Imports;

use App\Producto;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProductoImport implements ToModel, WithHeadingRow, WithValidation, WithStrictNullComparison
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producto([
            "id_producto" => $row["id_producto"], 
            "nombre_producto" => $row["nombre"],
            "codigo_producto" => $row["codigo"],
            "precio_producto" => $row["precio"]
        ]);
    }

    //validaciones del los campos
    public function rules() : array
    {
        return [
            'nombre_producto' => 'required|string',
            'codigo_producto' => 'regex:/[0-9]{10}/'
        ];
    }
}

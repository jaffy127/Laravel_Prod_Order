<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'ClienteController@index')->name('path_cliente_index');
Route::get('/productos', 'ProductoController@index')->name('path_producto_index');
Route::get('/ordenes', 'OrderController@index')->name('path_orden_index');
/*Route::get('/productos/{id_producto}', 'ProductoController@getByIdProd')->name('path_producto_index2');*/



Route::get('/home', 'HomeController@index')->name('home');

//email
Route::get('/contacto', 'ContactoController@contactoIndex')->name('path_contacto');
Route::post('/contacto', 'ContactoController@ajaxContacto')->name('path_ajax_contacto');

//ajax
Route::post('ajaxCliente', 'ClienteController@ajaxCliente')->name('path_ajax_cliente');
Route::post('ajaxProducto', 'ProductoController@ajaxProducto')->name('path_ajax_producto');
Route::post('ajaxOrden', 'OrderController@ajaxOrden')->name('path_ajax_orden');

/*----- exportaciones ---------*/
//Excel
Route::get('/exportar_clientes_excel', 'ClienteController@export_Excel_Cliente')->name('path_export_excel_cliente');
//Route::post('/importar_clientes_excel', 'ClienteController@import_Excel_Cliente')->name('path_import_excel_cliente');


//PDF
Route::get('exportar_clientes_pdf', 'ClienteController@export_PDF')->name('path_export_pdf_cliente');
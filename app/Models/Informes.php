<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Informes extends Model
{
    use HasFactory;
	protected $table = 'productoMasVendido';
    public function informeProductoMaxStock()
    {
    	$producto = DB::table('productos')
    	->select('productos.id','productos.nombreproducto', 'productos.referencia', 'productos.categoria', 'productos.stock')
    	->orderBy('productos.stock', 'desc')->limit(1)
    	->get();
        return $producto;
    }
    public function informeProductoMasVendido()
    {
    	$producto = DB::table('productoMasVendido')
    	->select('codigoProducto','cantidad', 'nombreproducto')
    	->get();
        return $producto;
    }
}

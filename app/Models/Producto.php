<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombreproducto', 'referencia', 'categoria', 'precio', 'peso', 'stock'];

    public function getProductos()
    {
    	$productos = DB::table('productos')
    	        	->select('productos.id','productos.nombreproducto', 'productos.referencia', 'productos.categoria', 'productos.precio')->get();
    	return $productos;
    }
    public function findProducto($id)
    {
        return static::find($id);
    }
    public function updateProducto($id, $input)
    {
        
        return static::find($id)->update($input);
    }
    public function deleteProducto($id)
    {
        DB::table('productos')->where('id', $id)->delete();
        return true;
    }
    public function getProductosSelector()
    {
        $productos = DB::table('productos')
                    ->select('productos.id','productos.nombreproducto')->get();
        return $productos;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function __construct()
    {
       $this->_mdProducto = new Producto();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = $this->_mdProducto->getProductos();
        $arrResponse = array(
            'title' => 'Productos',
            'productos' => $productos
        );
        return view('productos.index', $arrResponse);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Producto $producto)
    {
        $arrResponse = array();
        $data = $_REQUEST;
        try{
            $producto = new Producto;
            $producto->nombreproducto = $_REQUEST['nombreproducto'];
            $producto->referencia = $_REQUEST['referencia'];
            $producto->categoria = $_REQUEST['categoria'];
            $producto->precio = $_REQUEST['precio'];
            $producto->peso = $_REQUEST['peso'];
            $producto->stock = $_REQUEST['stock'];
            $producto->save();
            return response()->json(['status'=>'success', 'msg' => 'Pedido realizado con exito']);
        }
        catch(Exception $e){
            return response()->json(['status'=>'error', 'msg' => 'ocurrio un error !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $arrResponse = array();
        $id = $_REQUEST['id'];
        $producto = $this->_mdProducto->findProducto($id);
        return response()->json(['status'=>'sucess', 'producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $id = $_REQUEST['idProducto'];
        $nombreproducto = $_REQUEST['nombreproductoUpdate'];
        $referencia = $_REQUEST['referenciaUpdate'];
        $categoria = $_REQUEST['categoriaUpdate'];
        $precio = $_REQUEST['precioUpdate'];
        $peso = $_REQUEST['pesoUpdate'];
        $stock = $_REQUEST['stockUpdate'];
        $arrData = array(
            'nombreproducto' => $nombreproducto,
            'referencia' => $referencia,
            'categoria' => $categoria,
            'precio' => $precio,
            'peso' => $peso,
            'stock' => $stock
        );


        $producto = $this->_mdProducto->updateProducto($id, $arrData);
        return response()->json(['status'=>'sucess', 'msg' => $producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $arrResponse = array();
        $id = $_REQUEST['id'];
        $productos = $this->_mdProducto->deleteProducto($id);
        if ($productos) {
            $arrResponse['status'] = 'success';
            $arrResponse['msg'] = 'Producto eliminado con exito';
        } else {
            $arrResponse['status'] = 'error';
            $arrResponse['msg'] = 'Lo sentimos tenemos problemas al resolver su solcitud';
        }
        return response()->json($arrResponse);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
       $this->_mdProducto = new Producto();
       $this->_mdPedido = new Pedido();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = array();
        $arr['datos'] = $this->_mdProducto->getProductosSelector();
        return view('pedidos/index', $arr);
 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $arrResponse = array();
        $id = $_REQUEST['producto'];
        $cantidadPedido = $_REQUEST['stock'];
        $producto = $this->_mdProducto->findProducto($id);
        if ($cantidadPedido > $producto['stock']) {
            $arrResponse['status'] = 'error';
            $arrResponse['msg'] = 'no contamos con la cantidad de productos solicitados actualmente se tiene en inventario '.$producto['stock'].' '.$producto['nombreproducto'];
        } else {
            $arrResponse['status'] = 'success';
            $inventiarioDisponible = $producto['stock'] - $cantidadPedido;
            $arrResponse['msg'] = 'Pedido realizado con exito';
            //registrar venta
            $pedido = new Pedido();
            $pedido->codigoProducto = $id;
            $pedido->cantidadVenta = $cantidadPedido;
            $pedido->save();
            //actualizar producto
            $arrData = array('stock' => $inventiarioDisponible);
            $this->_mdProducto->updateProducto($id, $arrData);
            $arrResponse['cantidad'] = $inventiarioDisponible;
        }
        return response()->json($arrResponse);
    }
}

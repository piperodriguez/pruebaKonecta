<?php

namespace App\Http\Controllers;

use App\Models\Informes;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    public function __construct()
    {
       $this->_mdlInformes = new Informes();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrResponse = array();
        //consulta primer informe
        $arrResponse['informe1'] = $this->_mdlInformes->informeProductoMaxStock();
        $data = $this->_mdlInformes->informeProductoMasVendido();
        $arrData = array();
        $arrDataTwo = array(); 
        foreach ($data as $key => $value) {
            $arrData[$key]['cantidad'] = $value->cantidad;
            $arrDataTwo[$key]['cantidad'] = $value->cantidad;
            $arrDataTwo[$key]['producto'] = $value->nombreproducto;
        }
        $cantidadMax= MAX($arrData);
        $dataOut = array();
        foreach ($arrDataTwo as $key => $x) {
            
            if ($x['cantidad'] = $cantidadMax) {
               $dataOut['cantidad']=$x['cantidad'];
               $dataOut['nombre']=$x['producto'];
            }
        }
        $arrResponse['informe2'] = $dataOut;
        return view('informes/index', $arrResponse);
    }
}

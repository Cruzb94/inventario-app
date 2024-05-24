<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Salida;
use App\Models\Producto;
use App\Http\Requests\SalidaRequest;

class SalidasController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $salidas= Salida::all();
       // dd($salidas);
        return view('salidas.index', ['salidas'=>$salidas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $productos = Producto::all();
        return view('salidas.create', ['productos'=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SalidaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SalidaRequest $request)
    {
       // dd($request->all());


        $referencia = array();
        array_push($referencia, $request->input('referencia'));
        array_push($referencia, $request->input('cantidad'));

        //dd( $referencia );
    
       $salida = new Salida;
       $salida->referencia = json_encode($referencia);
       $salida->fecha = $request->input('fecha');
       $salida->guia = $request->input('guia');
       $salida->valor = $request->input('valor');
       $salida->estatsus = $request->input('estatus');

      // if($salida->save()) {
        for ($i = 0; $i < count($request->input('referencia')); $i++) {
            $producto = Producto::where('referencia', $request->input('referencia')[$i])->first();
    
            if ($request->input('cantidad')[$i] > $producto->stock) {
                return redirect()->route('salidas.create')->with('error', ' La Cantidad es mayor al inventario disponible');
            } else {
                $producto->stock =  $producto->stock - $request->input('cantidad')[$i];
                $producto->save();
            }
        }
           
        
        $salida->save();
        return to_route('salidas.index')->with('create','ok1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $salida = Salida::findOrFail($id);
        return view('salidas.show',['salida'=>$salida]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $salida = Salida::findOrFail($id);
        $productos = Producto::all();
        return view('salidas.edit',['salida'=>$salida, 'productos'=>$productos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SalidaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SalidaRequest $request, $id)
    {

        $referencia = array();
        array_push($referencia, $request->input('referencia'));
        array_push($referencia, $request->input('cantidad'));

    
        $salida = Salida::findOrFail($id);
		$salida->referencia = json_encode($referencia);
       $salida->fecha = $request->input('fecha');
       $salida->guia = $request->input('guia');
       $salida->valor = $request->input('valor');
       $salida->estatsus = $request->input('estatus');


       for ($i = 0; $i < count($request->input('referencia')); $i++) {
        $producto = Producto::where('referencia', $request->input('referencia')[$i])->first();

        if ($request->input('cantidad')[$i] > $producto->stock) {
            return redirect()->route('salidas.edit', $id)->with('error', ' La Cantidad es mayor al inventario disponible');
        } else {
            $producto->stock = $producto->stock - $request->input('cantidad')[$i];
            $producto->save();
        }
    }
       
    
    $salida->save();

        return to_route('salidas.index')->with('editar','ok2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $salida = Salida::findOrFail($id);
        $salida->delete();

        return to_route('salidas.index')->with('eliminar','ok3');
    }
}

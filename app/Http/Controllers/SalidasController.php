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
       // dd($request);
        $salida = new Salida;
		$salida->producto_id = $request->input('producto_id');
		$salida->fecha = $request->input('fecha');
		$salida->cantidad = $request->input('cantidad');
		$salida->guia = $request->input('guia');
		$salida->valor = $request->input('valor');
		$salida->estatsus = $request->input('estatus');
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
        $salida = Salida::findOrFail($id);
		$salida->producto_id = $request->input('producto_id');
		$salida->fecha = $request->input('fecha');
		$salida->cantidad = $request->input('cantidad');
		$salida->guia = $request->input('guia');
		$salida->valor = $request->input('valor');
		$salida->estatsus = $request->input('estatus');
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

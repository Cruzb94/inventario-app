<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Salida;
use App\Http\Requests\SalidaRequest;

class SalidasController extends Controller
{
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
        return view('salidas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SalidaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SalidaRequest $request)
    {
        $salida = new Salida;
		$salida->descripcion = $request->input('producto_id');
		$salida->fecha = $request->input('fecha');
		$salida->cantidad = $request->input('cantidad');
		$salida->guia = $request->input('guia');
		$salida->valor = $request->input('valor');
		$salida->estatus = $request->input('estatus');
        $salida->save();

        return to_route('salidas.index');
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
        return view('salidas.edit',['salida'=>$salida]);
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
		$salida->estatus = $request->input('estatus');
        $salida->save();

        return to_route('salidas.index');
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

        return to_route('salidas.index');
    }
}

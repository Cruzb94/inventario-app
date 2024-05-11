<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Entrada;
use App\Http\Requests\EntradaRequest;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $entradas= Entrada::all();
        return view('entradas.index', ['entradas'=>$entradas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('entradas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EntradaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EntradaRequest $request)
    {
        $entrada = new Entrada;
		$entrada->product_id = $request->input('product_id');
		$entrada->fecha = $request->input('fecha');
		$entrada->cantidad = $request->input('cantidad');
		$entrada->operario_id = $request->input('operario_id');
		$entrada->reproceso = $request->input('reproceso');
        $entrada->save();

        return to_route('entradas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('entradas.show',['entrada'=>$entrada]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('entradas.edit',['entrada'=>$entrada]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EntradaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EntradaRequest $request, $id)
    {
        $entrada = Entrada::findOrFail($id);
		$entrada->product_id = $request->input('product_id');
		$entrada->fecha = $request->input('fecha');
		$entrada->cantidad = $request->input('cantidad');
		$entrada->operario_id = $request->input('operario_id');
		$entrada->reproceso = $request->input('reproceso');
        $entrada->save();

        return to_route('entradas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return to_route('entradas.index');
    }
}

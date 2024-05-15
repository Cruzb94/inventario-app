<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Taller;
use App\Http\Requests\TallerRequest;

class TallersController extends Controller
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
        $tallers= Taller::all();
        return view('tallers.index', ['tallers'=>$tallers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tallers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TallerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TallerRequest $request)
    {
        $taller = new Taller;
		$taller->nombre = $request->input('nombre');
		$taller->referencia = $request->input('referencia');
		$taller->descripcion = $request->input('descripcion');
		$taller->fecha = $request->input('fecha');
		$taller->cantidad = $request->input('cantidad');
		$taller->valor_unidad = $request->input('valor_unidad');
		$taller->valor_total = $request->input('valor_total');
		$taller->observaciones = $request->input('observaciones');
		$taller->reprocesos = $request->input('reprocesos');
        $taller->save();

        return to_route('tallers.index')->with('create','ok1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $taller = Taller::findOrFail($id);
        return view('tallers.show',['taller'=>$taller]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $taller = Taller::findOrFail($id);
        return view('tallers.edit',['taller'=>$taller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TallerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TallerRequest $request, $id)
    {
        $taller = Taller::findOrFail($id);
		$taller->nombre = $request->input('nombre');
		$taller->referencia = $request->input('referencia');
		$taller->descripcion = $request->input('descripcion');
		$taller->fecha = $request->input('fecha');
		$taller->cantidad = $request->input('cantidad');
		$taller->valor_unidad = $request->input('valor_unidad');
		$taller->valor_total = $request->input('valor_total');
		$taller->observaciones = $request->input('observaciones');
		$taller->reprocesos = $request->input('reprocesos');
        $taller->save();

        return to_route('tallers.index')->with('editar','ok2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $taller = Taller::findOrFail($id);
        $taller->delete();

        return to_route('tallers.index')->with('eliminar','ok3');
    }
}

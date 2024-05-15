<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Ingreso;
use App\Http\Requests\IngresoRequest;

class IngresosController extends Controller
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
        $ingresos= Ingreso::all();
        return view('ingresos.index', ['ingresos'=>$ingresos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('ingresos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  IngresoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IngresoRequest $request)
    {
        $ingreso = new Ingreso;
		$ingreso->fecha = $request->input('fecha');
		$ingreso->cuenta_bancolombia = $request->input('cuenta_bancolombia');
		$ingreso->nequi = $request->input('nequi');
		$ingreso->efectivo = $request->input('efectivo');
		$ingreso->descripcion = $request->input('descripcion');
        $ingreso->save();

        return to_route('ingresos.index')->with('create','ok1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        return view('ingresos.show',['ingreso'=>$ingreso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        return view('ingresos.edit',['ingreso'=>$ingreso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  IngresoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IngresoRequest $request, $id)
    {
        $ingreso = Ingreso::findOrFail($id);
		$ingreso->fecha = $request->input('fecha');
		$ingreso->cuenta_bancolombia = $request->input('cuenta_bancolombia');
		$ingreso->nequi = $request->input('nequi');
		$ingreso->efectivo = $request->input('efectivo');
		$ingreso->descripcion = $request->input('descripcion');
        $ingreso->save();

        return to_route('ingresos.index')->with('editar','ok2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->delete();

        return to_route('ingresos.index')->with('eliminar','ok3');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Operario;
use App\Http\Requests\EntradaRequest;

class EntradasController extends Controller
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
        $entradas= Entrada::with('producto')->with('operario')->get();

        return view('entradas.index', ['entradas'=>$entradas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $entradas= Entrada::all();
        $productos = Producto::all();
        $operarios= Operario::all();
        return view('entradas.create', ['entradas'=>$entradas, 'productos'=>$productos,'operarios'=>$operarios]);
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
		$entrada->producto_id = $request->input('product_id');
		$entrada->fecha = $request->input('fecha');
		$entrada->cantidad = $request->input('cantidad');
		$entrada->operario_id = $request->input('operario_id');
		$entrada->reproceso = $request->input('reproceso');


        if($entrada->save()) {
            $producto = Producto::findOrFail($request->input('product_id'));
            $producto->stock =  $producto->stock +  $request->input('cantidad');
            $producto->save();
        }
        return to_route('entradas.index')->with('create','ok1');
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
        $productos = Producto::all();
        $operarios= Operario::all();
        return view('entradas.edit',['entrada'=>$entrada, 'productos'=>$productos,'operarios'=>$operarios]);
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
		$entrada->producto_id = $request->input('product_id');
		$entrada->fecha = $request->input('fecha');
		$entrada->cantidad = $request->input('cantidad');
		$entrada->operario_id = $request->input('operario_id');
		$entrada->reproceso = $request->input('reproceso');
      

        if($entrada->save()) {
            $producto = Producto::findOrFail($request->input('product_id'));
            $producto->stock =  $producto->stock +  $request->input('cantidad');
            $producto->save();
        }
        

        return to_route('entradas.index')->with('editar','ok2');
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

        return to_route('entradas.index')->with('eliminar','ok3');
    }
}

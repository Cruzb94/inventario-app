<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;

class ProductosController extends Controller
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
        $productos= Producto::all();
        return view('productos.index', ['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductoRequest $request)
    {
        $producto = new Producto;
		$producto->referencia = $request->input('referencia');
		$producto->descripcion = $request->input('descripcion');
		$producto->entrada = $request->input('entrada');
		$producto->salida = $request->input('salida');
		$producto->stock = $request->input('stock');
        $producto->save();

        return to_route('productos.index')->with('create','ok1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show',['producto'=>$producto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit',['producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
		$producto->referencia = $request->input('referencia');
		$producto->descripcion = $request->input('descripcion');
		$producto->entrada = $request->input('entrada');
		$producto->salida = $request->input('salida');
		$producto->stock = $request->input('stock');
        $producto->save();

        return to_route('productos.index')->with('editar','ok2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return to_route('productos.index')->with('eliminar','ok3');
    }
}

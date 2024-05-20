<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Taller;
use App\Models\Producto;
use App\Models\Operario;
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
        $productos = Producto::all();
        $operarios = Operario::all();

        //dd($productos);

        return view('tallers.create', ['productos' =>$productos, 'operarios'  =>$operarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TallerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TallerRequest $request)
    {
        
   $data = $request->all();

//dd($data);
   $referencias = [];
   $descripciones = [];
   $valoresUnidad = [];
   $cantidades = [];


   for ($i = 1; $i <= count($data) / 4; $i++) {
    if (isset($data['referencia' . $i])) {
        $producto = Producto::findOrFail($data['referencia' . $i]);
        $referencias[] = $producto->referencia; // Guardar la referencia en lugar del ID
        $descripciones[] = $data['descripcion' . $i];
        $valoresUnidad[] = $data['valor_unidad' . $i];
        $cantidades[] = $data['cantidad' . $i];
    }
}
//dd($referencias,$descripciones,$valoresUnidad,$cantidades);

        $referencia = array();
        array_push($referencia, $referencias);
        array_push($referencia, $descripciones);
        array_push($referencia, $valoresUnidad);
        array_push($referencia, $cantidades);

        $taller = new Taller;
		$taller->operario_id = $request->input('nombre');
		$taller->referencia = json_encode( $referencia);
		$taller->fecha = $request->input('fecha');
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
        $referencia = json_decode($taller->referencia);
    
        [$referencias, $descripciones, $valoresUnidad, $cantidades] = $referencia;

        $productosConReferencias = [];
    foreach ($referencias as $ref) {
        $producto = Producto::where('referencia', $ref)->first();
        if ($producto) {
            $productosConReferencias[] = $producto->id;
        }
    }

      // dd($productosConReferencias,$referencias);
    
        $productos = Producto::all();
        $operarios = Operario::all();
    
        return view('tallers.edit', compact('taller', 'operarios', 'productosConReferencias', 'descripciones', 'valoresUnidad', 'cantidades','productos'));
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
        dd($request->all());
        $taller = Taller::findOrFail($id);
		$taller->nombre = $request->input('nombre');
		$taller->referencia = $request->input('referencia');
		$taller->fecha = $request->input('fecha');
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

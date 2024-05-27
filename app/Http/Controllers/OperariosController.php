<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Operario;
use App\Http\Requests\OperarioRequest;
use Illuminate\Http\Request;


class OperariosController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Operario::query();
    
        // Aplicar filtro de fechas si están presentes en la solicitud
        if ($request->has(['fecha_inicio', 'fecha_fin'])) {
            $query->whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin]);
        }
    
        // Obtener los resultados del query
        $operarios = $query->get();
    
        // Pasar los resultados a la vista
        return view('operarios.index', ['operarios' => $operarios]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('operarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OperarioRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OperarioRequest $request)
    {
        $operario = new Operario;
		$operario->name = $request->input('name');
        $operario->nit = $request->input('nit');
        $operario->numero_contacto = $request->input('numero_contacto');
        $operario->direccion = $request->input('direccion');
        $operario->fecha_ingreso = $request->input('fecha_ingreso');
        $operario->save();

        return to_route('operarios.index')->with('create','ok1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $operario = Operario::findOrFail($id);
        return view('operarios.show',['operario'=>$operario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $operario = Operario::findOrFail($id);
        return view('operarios.edit',['operario'=>$operario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OperarioRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperarioRequest $request, $id)
    {
        $operario = Operario::findOrFail($id);
		$operario->name = $request->input('name');
        $operario->numero_contacto = $request->input('numero_contacto');
        $operario->direccion = $request->input('direccion');
        $operario->fecha_ingreso = $request->input('fecha_ingreso');
        $operario->save();

        return to_route('operarios.index')->with('editar','ok2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $operario = Operario::findOrFail($id);
        $operario->delete();

        return to_route('operarios.index')->with('eliminar','ok3');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Operario;
use App\Http\Requests\OperarioRequest;

class OperariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $operarios= Operario::all();
        return view('operarios.index', ['operarios'=>$operarios]);
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
        $operario->save();

        return to_route('operarios.index');
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
        $operario->save();

        return to_route('operarios.index');
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

        return to_route('operarios.index');
    }
}

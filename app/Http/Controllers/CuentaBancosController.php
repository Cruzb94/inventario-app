<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CuentaBanco;
use App\Http\Requests\CuentaBancoRequest;

class CuentaBancosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cuentabancos= CuentaBanco::all();
        return view('cuentabancos.index', ['cuentabancos'=>$cuentabancos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('cuentabancos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CuentaBancoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CuentaBancoRequest $request)
    {
        $cuentabanco = new CuentaBanco;
		$cuentabanco->name = $request->input('name');
		$cuentabanco->nombre_banco = $request->input('nombre_banco');
		$cuentabanco->nro_cuenta = $request->input('nro_cuenta');
        $cuentabanco->save();

        return to_route('cuentabancos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $cuentabanco = CuentaBanco::findOrFail($id);
        return view('cuentabancos.show',['cuentabanco'=>$cuentabanco]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $cuentabanco = CuentaBanco::findOrFail($id);
        return view('cuentabancos.edit',['cuentabanco'=>$cuentabanco]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CuentaBancoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CuentaBancoRequest $request, $id)
    {
        $cuentabanco = CuentaBanco::findOrFail($id);
		$cuentabanco->name = $request->input('name');
		$cuentabanco->nombre_banco = $request->input('nombre_banco');
		$cuentabanco->nro_cuenta = $request->input('nro_cuenta');
        $cuentabanco->save();

        return to_route('cuentabancos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cuentabanco = CuentaBanco::findOrFail($id);
        $cuentabanco->delete();

        return to_route('cuentabancos.index');
    }
}

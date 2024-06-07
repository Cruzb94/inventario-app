<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Reproceso;
use App\Models\Entrada;
//use App\Http\Requests\OperarioRequest;
use Illuminate\Http\Request;


class ReprocesosController extends Controller
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
        $reprocesos = Reproceso::with('entrada')->get()->toArray();
        $entrada = Entrada::where('id', $reprocesos[0]['entrada']['id'])->with('operario')->with('producto')->get();
     //   dd($reprocesos[0]['entrada']['operario_id']);
        // Pasar los resultados a la vista
        dd($entrada);
        return view('reprocesos.index', ['entrada' => $entrada]);
    }
    
}

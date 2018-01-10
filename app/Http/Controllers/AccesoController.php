<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acceso;

class AccesoController extends Controller
{
    public function create(Request $request) {
    	$acceso = new Acceso;
    	$acceso->usuario_id = $request->input('usuario');
    	$acceso->app_id = $request->input('app');
    	$acceso->save();
    }

    public function delete(Request $request) {
    	Acceso::where([
    		['usuario_id', '=', $request->input('usuario')],
    		['app_id', '=', $request->input('app')]
    	])->delete();
    }
}

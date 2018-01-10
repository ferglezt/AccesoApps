<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Usuario;
use App\App;
use App\Acceso;
use DB;

class UsuarioController extends Controller
{
    public function index(Request $request) {
    	return view('users', [
    		'users' => Usuario::all(),
    		'apps' => App::all(),
    		'accesos' => Acceso::all()
    	]);
    }

    public function passwordReset(Request $request, $id = 0) {
        $user = Usuario::findOrFail($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();
    }

    public function create(Request $request) {
        if(Usuario::where('nombre', '=', $request->input('nombre'))->first()) {
            abort(409);
        }

        $user = new Usuario;
        $user->nombre = $request->input('nombre');
        $user->comentario = $request->input('comentario');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $accesos = [];

        foreach ((array)$request->input('apps') as $app) {
            array_push($accesos, ['usuario_id' => $user->id, 'app_id' => $app]);
        }

        DB::table('Acceso')->insert($accesos);
    }

    public function update(Request $request, $id = 0) {
        $user = Usuario::findOrFail($id);

        //Tratan de actualizar el nombre de usuario
        if($user->nombre != $request->input('nombre')) {
            //Nombre de usuario no disponible. UNIQUE contsrait
            if(Usuario::where('nombre', '=', $request->input('nombre'))->first()) {
                abort(409);
            }
        }

        $user->nombre = $request->input('nombre');
        $user->comentario = $request->input('comentario');
        $user->save();
    }

    public function delete(Request $request, $id = 0) {
        $user = Usuario::findOrFail($id);
        $user->delete();
    }

}

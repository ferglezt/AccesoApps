<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;

class AppController extends Controller
{
    public function index(Request $request) {
    	return view('apps', ['apps' => App::all()]);
    }

    public function update(Request $request, $id = 0) {
    	$app = App::findOrFail($id);
    	$app->nombre = $request->input('nombre');
    	$app->diasAcceso = $request->input('dias');
    	$app->save();
    }

    public function create(Request $request) {
    	$app = new App;
    	$app->nombre = $request->input('nombre');
    	$app->diasAcceso = $request->input('dias');
    	$app->save();
    }

    public function delete(Request $request, $id = 0) {
    	$app = App::findOrFail($id);
    	$app->delete();
    }
}

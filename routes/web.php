<?php

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('apps')->group(function() {
	Route::get('', 'AppController@index');
	Route::post('{id}/update', 'AppController@update');
	Route::post('create', 'AppController@create');
	Route::post('{id}/delete', 'AppController@delete');
});

Route::prefix('users')->group(function() {
	Route::get('', 'UsuarioController@index');
	Route::post('create', 'UsuarioController@create');
	Route::post('{id}/delete', 'UsuarioController@delete');
	Route::post('{id}/update', 'UsuarioController@update');
	Route::post('{id}/passwordReset', 'UsuarioController@passwordReset');
});

Route::prefix('access')->group(function() {
	Route::post('create', 'AccesoController@create');
	Route::post('delete', 'AccesoController@delete');
});



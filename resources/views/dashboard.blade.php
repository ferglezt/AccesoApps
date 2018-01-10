@extends('layouts.master')

@section('title', 'Bienvenido')

@section('dropdown')

    @include('dropdownMenu')

@stop

@section('sidebar')

    @include('sidebar')
 
@stop

@section('content')

    <div class="jumbotron text-center">
        <h1>Bienvenido</h1>
        <p>Registro y control de apps</p> 
    </div>

@stop

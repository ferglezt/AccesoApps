@extends('dashboard')

@section('title', 'Apps')

@section('content')

	<script type="text/javascript" src="{{ URL::to('/') }}/js/apps.js"></script>

	<div class="container-fluid">

    <div class="page-header">
      <h1>Apps</h1>      
    </div>

    <div class="row">
      <div class="col-md-12">
        <table id="appsTable" class="cell-border" width="100%">
        	<thead>
        	  <th>Id</th>
        	  <th>App</th>
        	  <th>Días de Acceso</th>
            <th></th>
            <th></th>
        	</thead>
        	<tbody>
        	  @foreach($apps as $app)
              <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->nombre }}</td>
                <td>{{ $app->diasAcceso }}</td>
                <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditar" data-nombre="{{ $app->nombre }}" data-id={{ $app->id }} data-dias="{{ $app->diasAcceso }}">Editar</button></td>
                <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBorrar" data-nombre="{{ $app->nombre }}" data-id={{ $app->id }}>Borrar</button></td>
              </tr>
            @endforeach
        	</tbody>
          <tfoot>
            <tr>
              <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalNuevaApp">Nueva App</button></td>
            </tr>
          </tfoot>
        </table>	
      </div>
    </div>

    <!-- Modal Borrar-->
    <div id="modalBorrar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">¿Seguro que desea borrar esta App?</h4>
          </div>
          <div class="modal-body">
            <p id="nombre"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
            <button id="borrar" type="button" class="btn btn-danger">Borrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar-->
    <div id="modalEditar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar App</h4>
          </div>
          <div class="modal-body">
            <label>Nombre:</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            <br>
            <label>Dias de Acceso:</label>
            <input type="number" id="dias" class="form-control" placeholder="Días de Acceso">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
            <button id="guardar" type="button" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar-->
    <div id="modalNuevaApp" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nueva App</h4>
          </div>
          <div class="modal-body">
            <label>Nombre:</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            <br>
            <label>Dias de Acceso:</label>
            <input type="number" id="dias" class="form-control" placeholder="Días de Acceso">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
            <button id="guardar" type="button" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal Éxito-->
      <div id="modalMessage" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Alerta</h4>
            </div>
            <div id="message" class="modal-body alert">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

  </div>

@stop
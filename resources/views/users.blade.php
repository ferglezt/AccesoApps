@extends('dashboard')

@section('title', 'Usuarios')

@section('content')

	<script type="text/javascript" src="{{ URL::to('/') }}/js/users.js"></script>

	<div class="container-fluid">

    <div class="page-header">
      <h1>Usuarios</h1>      
    </div>

    <div class="row">
      <div class="col-md-12">
        <table id="usersTable" class="cell-border" width="100%">
        	<thead>
        	  <th>Id</th>
        	  <th>Nombre</th>
        	  <th>Comentario</th>
            <th></th>
            <th></th>
            <th></th>
            @foreach($apps as $app)
              <th>{{ $app->nombre }}</th>
            @endforeach
        	</thead>
        	<tbody>
        	  @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->comentario }}</td>
                <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditar" data-nombre="{{ $user->nombre }}" data-id="{{ $user->id }}" data-comentario="{{ $user->comentario }}">Editar</button></td>
                <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBorrar" data-nombre="{{ $user->nombre }}" data-id="{{ $user->id }}">Borrar</button></td>
                <td><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalPasswordReset" data-nombre="{{ $user->nombre }}" data-id="{{ $user->id }}">Reset password</button></td>
                @foreach($apps as $app)
                  <td>
                    <input type="checkbox" class="acceso" usuario_id="{{ $user->id }}" app_id="{{ $app->id }}" 
                      @if($accesos->where('usuario_id', $user->id)->where('app_id', $app->id)->first())
                        checked 
                      @endif
                    >
                  </td>
                @endforeach
              </tr>
            @endforeach
        	</tbody>
        </table>	
      </div>
    </div>

    <div class="row">
      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalNuevoUsuario" style="margin-left: 15px">Nuevo Usuario</button>
    </div>

    <!-- Modal Borrar-->
    <div id="modalBorrar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">¿Seguro que desea borrar este usuario?</h4>
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

    <!-- Modal Reset Password-->
    <div id="modalPasswordReset" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reset Password</h4>
          </div>
          <div class="modal-body">
            <p id="nombre"></p>
            <label>Password:</label>
            <input type="text" id="password" class="form-control" placeholder="Password">
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
            <button id="guardar" type="button" class="btn btn-success">Guardar</button>
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
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div class="modal-body">
            <label>Nombre:</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            <br>
            <label>Comentario:</label>
            <input type="text" id="comentario" class="form-control" placeholder="Comentario">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
            <button id="guardar" type="button" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar-->
    <div id="modalNuevoUsuario" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nuevo Usuario</h4>
          </div>
          <div class="modal-body">
            <label>Nombre:</label>
            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            <br>
            <label>Comentario:</label>
            <input type="text" id="comentario" class="form-control" placeholder="Comentario">
            <br>
            <label>Password:</label>
            <input type="text" id="password" class="form-control" placeholder="Password">
            <br>
            @foreach($apps as $app)
              <input type="checkbox" value="{{ $app->id }}">
              <label>{{ $app->nombre }}</label><br>
            @endforeach
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
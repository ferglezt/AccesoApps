$(document).ready(function() {
	$('#item-admin-users').addClass('active');

	$('#item-admin-users').click(function(e) {
		e.preventDefault();
	});

	$('#submenu-apps').addClass('in');

	var table = $('#usersTable').DataTable({
		"searching": false,
		"language": {
			"lengthMenu": "Mostrando _MENU_ registros por página",
			"zeroRecords": "No se encontraron registros",
			"info": "Mostrando página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(de _MAX_ registros totales)",
			"search": "Buscar",
			"paginate": {
				"previous": "Anterior",
				"next": "Siguiente"
			}
		}
	});

	var commonErrorStatusCodes = function() {
		return {
			404: function() {
				$('#modalMessage #message').removeClass('alert-success');
				$('#modalMessage #message').addClass('alert-danger');
				$('#modalMessage #message').html('Dirección no encontrada');
				$('#modalMessage').modal('show');
			},
			500: function(xhr) {
				$('#modalMessage #message').removeClass('alert-success');
				$('#modalMessage #message').addClass('alert-danger');
				$('#modalMessage #message').html('Error de servidor');
				$('#modalMessage').modal('show');
			},
			401: function() {
				$('#modalMessage #message').removeClass('alert-success');
				$('#modalMessage #message').addClass('alert-danger');
				$('#modalMessage #message').html('No tiene permisos para realizar esta acción');
				$('#modalMessage').modal('show');
			},
			409: function() {
				$('#modalMessage #message').removeClass('alert-success');
				$('#modalMessage #message').addClass('alert-danger');
				$('#modalMessage #message').html('Este nombre de usuario no está disponible');
				$('#modalMessage').modal('show');
			}
		}
	};

	$('#modalPasswordReset').on('show.bs.modal', function(e) {
		var nombre = e.relatedTarget.dataset.nombre;
		var id = e.relatedTarget.dataset.id;

		$('#modalPasswordReset #nombre').text(nombre);

		$('#modalPasswordReset #guardar').unbind('click').click(function() {
			$.ajax({
				url: '/users/' + id + '/passwordReset',
				type: 'POST',
				data: {
					'password': $('#modalPasswordReset #password').val()
				},
				success: function(result,status,xhr) {
					$('#modalPasswordReset').modal('hide');
					$('#modalMessage #message').removeClass('alert-danger');
					$('#modalMessage #message').addClass('alert-success');
					$('#modalMessage #message').html('Password actualizado para: ' + nombre);
					$('#modalMessage').modal('show');
				},
				error: function() {
					$('#modalPasswordReset').modal('hide');
				},
				statusCode: commonErrorStatusCodes()
			});
		});
	});

	$('#modalEditar').on('show.bs.modal', function(e) {
		var nombre = e.relatedTarget.dataset.nombre;
		var id = e.relatedTarget.dataset.id;
		var comentario = e.relatedTarget.dataset.comentario;

		$('#modalEditar #nombre').val(nombre);
		$('#modalEditar #comentario').val(comentario);

		$('#modalEditar #guardar').unbind('click').click(function() {
			$.ajax({
				url: '/users/' + id + '/update',
				type: 'POST',
				data: {
					'nombre': $('#modalEditar #nombre').val(),
					'comentario': $('#modalEditar #comentario').val()
				},
				success: function(result,status,xhr) {
					window.location.reload(true);
				},
				error: function() {
					$('#modalEditar').modal('hide');
				},
				statusCode: commonErrorStatusCodes()
			});
		});
	});

	$('#modalBorrar').on('show.bs.modal', function(e) {
		var nombre = e.relatedTarget.dataset.nombre;
		var id = e.relatedTarget.dataset.id;

		$('#modalBorrar #nombre').text(nombre);

		$('#modalBorrar #borrar').unbind('click').click(function() {
			$.ajax({
				url: '/users/' + id + '/delete',
				type: 'POST',
				data: {},
				success: function(result,status,xhr) {
					window.location.reload(true);
				},
				error: function() {
					$('#modalBorrar').modal('hide');
				},
				statusCode: commonErrorStatusCodes()
			});
		});
	});

	$('#modalNuevoUsuario').on('show.bs.modal', function(e) {
		$('#modalNuevoUsuario #nombre').val('');
		$('#modalNuevoUsuario #comentario').val('');
		$('#modalNuevoUsuario #password').val('');

		$('#modalNuevoUsuario input[type=checkbox]').each(function() {
			$(this).prop('checked', false);
		});

		$('#modalNuevoUsuario #guardar').unbind('click').click(function() {
			var apps = $('#modalNuevoUsuario input[type=checkbox]').filter(function() {
				return $(this).is(':checked');
			}).map(function(){
				return $(this).val()
			}).get();

			$.ajax({
				url: '/users/create',
				type: 'POST',
				data: {
					'nombre': $('#modalNuevoUsuario #nombre').val(),
					'comentario': $('#modalNuevoUsuario #comentario').val(),
					'password': $('#modalNuevoUsuario #password').val(),
					'apps': apps
				},
				success: function(result,status,xhr) {
					window.location.reload(true);
				},
				error: function() {
					$('#modalNuevoUsuario').modal('hide');
				},
				statusCode: commonErrorStatusCodes()
			});
		});
	});

	$('.acceso').click(function() {
		var checkbox = $(this);

		var app = checkbox.attr('app_id');
		var usuario = checkbox.attr('usuario_id');
		var checked = checkbox.is(':checked');

		checkbox.prop('checked', !checked);
		checkbox.prop('disabled', true);

		var url = '';

		if(checked) {
			url = '/access/create';
		} else {
			url = '/access/delete';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				'app': app,
				'usuario': usuario
			},
			success: function(result,status,xhr) {
				checkbox.prop('checked', checked);
			},
			complete: function(xhr,status) {
				checkbox.prop('disabled', false);
			},
			statusCode: commonErrorStatusCodes()	

		});
	
	});


});
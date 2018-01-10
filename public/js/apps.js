$(document).ready(function() {
	$('#item-admin-apps').addClass('active');

	$('#item-admin-apps').click(function(e) {
		e.preventDefault();
	});

	$('#submenu-apps').addClass('in');

	var table = $('#appsTable').DataTable({
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
			}
		}
	};

	$('#modalBorrar').on('show.bs.modal', function(e) {
		var nombre = e.relatedTarget.dataset.nombre;
		var id = e.relatedTarget.dataset.id;

		$('#modalBorrar #nombre').text(nombre);

		$('#modalBorrar #borrar').unbind('click').click(function(e) {
			$.ajax({
				url: '/apps/' + id + '/delete',
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

	$('#modalNuevaApp').on('show.bs.modal', function(e) {
		$('#modalNuevaApp #nombre').val('');
		$('#modalNuevaApp #dias').val(1);

		$('#modalNuevaApp #guardar').unbind('click').click(function(e) {
			$.ajax({
				url: '/apps/create',
				type: 'POST',
				data: {
					'nombre': $('#modalNuevaApp #nombre').val(),
					'dias': $('#modalNuevaApp #dias').val()
				},
				success: function(result,status,xhr) {
					window.location.reload(true);
				},
				error: function() {
					$('#modalNuevaApp').modal('hide');
				},
				statusCode: commonErrorStatusCodes()
			});
		});
	});

	$('#modalEditar').on('show.bs.modal', function(e) {
		var nombre = e.relatedTarget.dataset.nombre;
		var dias = e.relatedTarget.dataset.dias;
		var id = e.relatedTarget.dataset.id;

		$('#modalEditar #nombre').val(nombre);
		$('#modalEditar #dias').val(dias);

		$('#modalEditar #guardar').unbind('click').click(function(e) {
			$.ajax({
				url: '/apps/' + id + '/update',
				type: 'POST',
				data: {
					'nombre': $('#modalEditar #nombre').val(),
					'dias': $('#modalEditar #dias').val()
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

});
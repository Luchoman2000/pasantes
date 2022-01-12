<?php
if ($_SESSION['rol'] == 'PASANTE') {
	// var_dump($_SESSION);
?>
	<div class="card">
		<div class="card-content">
			<div class="container mW alignCenter content">
				<h1 class="title has-text-success">Bienvenido</h1>
				<h1 class="subtitle"><?php $n = strtolower($_SESSION['nombre'] . " " . $_SESSION['apellido']);
										echo ucwords($n); ?></h1>
				<p>Registra tu asistencia a continuación:</p>
			</div>
		</div>
	</div>

	<br>
	<br>

	<div class="container">
		<div class="card">
			<div class="card-content">
				<div class="content">
					<div id="marcador" class="list has-visible-pointer-controls">
						<!-- RELOJ -->
						<div id="holder" style="min-height: 84px;">
							<div id="time-holder">
								<div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
							</div>
							<div id="date-holder">
								<div class="is-5 has-text-success has-text-centered" id="display-date"></div>
								<div class="has-text-centered" id="display-day"></div>
							</div>
						</div>
						<br>
						<div class="aEstado notification is-success is-light is-hidden">
							<button class="delete"></button>
							Día completado 😃
						</div>
						<?php
						require_once './controller/asistencia.controlador.php';
						$asistencia = new AsistenciaControlador();
						echo $asistencia->CtrMostrarInicioPasante();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>

	<script>
		$(function() {
			if ($('#des_m_salida').text() != 'Sin marcar' && $('#des_m_salida').length != 0) {
				$('.aEstado').fadeIn(600);
				$('.aEstado').removeClass('is-hidden');
			} else {
				$('.aEstado').hide();
				$('.aEstado').addClass('is-hidden');
			}
			(document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
				const $notification = $delete.parentNode;
				$delete.addEventListener('click', () => {
					$($notification).fadeOut(300);
				});
			});
		})
	</script>
	
<?php
} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {
?>
	<link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma-list.css">
	<div class="card">
		<div class="card-content">
			<div class="container mW alignCenter content">
				<h1 class="title has-text-success">Bienvenido</h1>
				<!-- <h1 class="subtitle"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h1> -->

			</div>
		</div>
	</div>
	<br>
	<br>


	<div class="container">
		<div class="card">
			<div class="card-content">
				<div class="content">
					<div id="holder" style="min-height: 84px;">
						<div id="time-holder">
							<div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
						</div>
						<div id="date-holder">
							<div class="is-5 has-text-success has-text-centered" id="display-date"></div>
							<div class="has-text-centered" id="display-day"></div>
						</div>
					</div>
					<br>
					<!-- Boton-->
					<div class="columns is-mobile">
						<div class="column">
							<div class="field has-addons">
								<div class="control">
									<button id="nuevo_registros" class="button is-success modal-button" data-target="nuevo_registro" data-toggle="modal">
										<span class="icon is-small">
											<i class="fa fa-plus"></i>
										</span>
										<span>Nueva asistencia</span>
									</button>
									<button id="reporte_usuario" class="button is-primary modal-button" data-target="nuevo_reporte_pasante" data-toggle="modal">
										<span class="icon is-small">
											<i class="fa fa-file"></i>
										</span>
										<span>Exportar</span>
									</button>
								</div>
							</div>

						</div>
					</div>

					<div class="box" id="contacts">
						<p class="title is-size-3 mb-4 has-text-info-dark">Asistencias de hoy</p>


						<div class="list">
							<?php
							require_once './controller/asistencia.controlador.php';
							$asistencia = new AsistenciaControlador();
							echo $asistencia->CtrMostrarInicioAdmin();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-fx-fadeInScale" id="edit_hora">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="modal-card">

				<form id="guardar_edicion" novalidate>


					<header class="modal-card-head">
						<p class="modal-card-title"><strong>Editar asistencia</strong> </p>
					</header>

					<section class="modal-card-body">

						<div class="card mb-4 p-3 blockHorario">
							<h3 class="is-inline">Entrada: </h3>
							<p class="is-inline" id="hor_entrada"></p>
							<h3 class="is-inline-block">Estado: </h3>
							<p class="is-inline" id="asi_estado"></p>
							<br>
							<h3 class="is-inline-block">Límite: </h3>
							<p class="is-inline" id="hor_limite">10</p>
						</div>

						<div class="columns">
							<div class="column is-5">
								<label class="label has-text-info">Hora de ingreso:</label>
							</div>
							<div class="column">
								<input id="h_entrada_u" style="width: 60%; height:29px;" type="time" name="h_entrada_u" step="2">
								<span class="tag is-white is-link is-light ml-2"></span>
							</div>
						</div>

						<div class="columns">
							<div class="column is-5">
								<label class="label has-text-info">Hora inicio del almuerzo:</label>
							</div>
							<div class="column">
								<input id="h_almuerzo_start_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_start_u" step="2">
								<span class="tag is-white is-link is-light ml-2">11:12:12</span>
							</div>
						</div>

						<div class="columns">
							<div class="column is-5">
								<label class="label has-text-info">Hora fin del almuerzo:</label>
							</div>
							<div class="column">
								<input id="h_almuerzo_end_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_end_u" step="2">
								<span class="tag is-white is-link is-light ml-2">11:12:12</span>
							</div>
						</div>

						<div class="columns">
							<div class="column is-5">
								<label class="label has-text-info">Hora salida:</label>
							</div>
							<div class="column">
								<input id="h_salida_u" style="width: 60%; height:29px;" type="time" name="h_salida_u" step="2">
								<span class="tag is-white is-link is-light ml-2">11:12:12</span>
							</div>
						</div>

						<div class="columns">
							<div class="column">
								<label class="label has-text-info">Observación</label>
								<textarea style="width: 100%; height: 59px;" class="textarea" placeholder="Observación" id="asi_obserbacion" name="asi_observacion"></textarea>

							</div>
							<input id="asiId" type="hidden" name="asiId_u">
                            <input id="id_h" type="hidden" name="horario" value="<?php echo $horario['hor_id'] ?>">
						</div>
					</section>

					<footer class="modal-card-foot">
						<button type="submit" class="button is-success">Guardar</button>
						<!-- <button class="button">Cancelar</button> -->
					</footer>

				</form>


			</div>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>

	<div class="modal modal-fx-fadeInScale" id="nuevo_registro">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="modal-card">

				<header class="modal-card-head">
					<p class="modal-card-title"><strong>Nuevo registro</strong> </p>
				</header>
				<!-- Tabla de pasantes -->
				<section class="modal-card-body">


					<div class="table-container" style="overflow-x: hidden;">



						<?php
						require_once './controller/asistencia.controlador.php';
						$asistencia = new AsistenciaControlador();
						echo  $asistencia->CtrMostrarPasantesSinRegistro();
						?>
						</table>

					</div>
				</section>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>

	<div class="modal modal-fx-fadeInScale" id="nuevo_reporte_pasante">
		<div class="modal-background"></div>
		<div class="modal-content">
			<div class="modal-card">
				<form method="POST" id="exportarPdf" action="<?php echo SERVERURL ?>ajax/reporte.ajax.php">
					<input type="hidden" name="reporte_registro_pasante_total" value="1">
					<header class="modal-card-head">
						<p class="modal-card-title">Generar reporte de hoy</p>
					</header>
					<section style="height: auto;" class="modal-card-body">
						<input type="date" name="fecha_reporte_pasante" id="fecha_reporte_pasante" value="<?php echo date('Y-m-d'); ?>">
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success">Generar</button>
					</footer>
				</form>
			</div>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>

	<br>
	<br>

	<script>
		var table_add = $('#pasantes').DataTable({

			"language": {
				"url": "./src/es_es.json"
			},
			searching: true,
			pagin: true,
			autoWidth: false,
			"pagingType": "simple",
			lengthChange: false,
			responsive: false,

			columnDefs: [{
				width: 1000,
				targets: 0
			}],
		});
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			(document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
				const $notification = $delete.parentNode;

				$delete.addEventListener('click', () => {
					$notification.parentNode.removeChild($notification);
				});
			});
		});
	</script>

	<script>
		$(document).on('click', '.verRegistro', function() {
			var id = $(this).attr('id');
			window.location.href = "registro/" + id;
		})
		$(document).on('click', '.verObservacion', function() {
			var id = $(this).attr('id');
			var obs;
			fetch(SERVERURL + '/pasantes/ajax/asistencia.ajax.php?getObservacion=' + id).then(response => response.text()).then(result => {
				Swal.fire({
					title: 'Observación',
					text: result,
				})

			});
		})
	</script>
<?php
}
?>

<script>
	window.setInterval(function() {
		$("#display-time").html(moment().format("LTS"));
		$("#display-date").html(moment().format("DD/MM/YYYY"));
		$("#display-day").html(ucwords(moment().locale('es').format("dddd")));
	}, 1000);

	$(function() {})

	function ucwords(str) {
		return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
			return $1.toUpperCase();
		});
	}
</script>
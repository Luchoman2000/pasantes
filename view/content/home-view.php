<?php
if ($_SESSION['rol'] == 'PASANTE') {
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
						<div id="holder">
							<div id="time-holder">
								<div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
							</div>
							<div id="date-holder">
								<div class="subtitle is-5 has-text-success has-text-centered" id="display-date"></div>
								<div class="has-text-centered" id="display-day"></div>
							</div>
						</div>
						<br>

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
					<div id="holder">
						<div id="time-holder">
							<div class="title is-3 has-text-centered has-text-info has-text-shadow" id="display-time"></div>
						</div>
						<div id="date-holder">
							<div class="subtitle is-5 has-text-success has-text-centered" id="display-date"></div>
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
						<h1 class="title is-4 mb-2 has-text-info-dark">Asistencias de hoy</h1>


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

						<input id="asiId" type="hidden" name="asiId_u">
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
					<section class="modal-card-body">
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
		var table = $('#pasantes').DataTable({

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
			console.log(id);
			window.location.href = "registro/" + id;
		})
	</script>
<?php
}
?>

<script>
	// moment.locale('es');
	window.setInterval(function() {
		$("#display-time").html(moment().format("LTS"));
		$("#display-date").html(moment().format("DD/MM/YYYY"));
		$("#display-day").html(moment().locale('es').format("dddd"));
	}, 1000);

	// setInterval(function() {
	// 	setTime();
	// 	setDate();
	// }, 200);

	// function setTime() {
	// 	var disp_time = document.getElementById("display-time");
	// 	let time = new Date();
	// 	let hours = time.getHours();
	// 	let minutes = time.getMinutes();
	// 	let seconds = time.getSeconds();
	// 	let period = "PM";
	// 	if (seconds < 10) {
	// 		seconds = "0" + seconds;
	// 	}
	// 	if (minutes < 10) {
	// 		minutes = "0" + minutes;
	// 	}
	// 	if (hours < 12) {
	// 		period = "AM";
	// 	}
	// 	if (hours == 0) {
	// 		hours = "12";
	// 	}
	// 	if (hours > 12) {
	// 		hours = hours - 12;
	// 	}
	// 	if (hours < 10) {
	// 		hours = "0" + hours;
	// 	}
	// 	disp_time.innerHTML = hours + ":" + minutes + ":" + seconds + " " + period;
	// }

	// function setDate() {
	// 	var disp_date = document.getElementById("display-date");
	// 	var disp_day = document.getElementById("display-day");
	// 	let time = new Date();
	// 	let date = time.getDate();
	// 	let month = time.getMonth();
	// 	let year = time.getFullYear();
	// 	let day = time.getDay();
	// 	switch (day) {
	// 		case 0:
	// 			day = "Domingo";
	// 			break;
	// 		case 1:
	// 			day = "Lunes";
	// 			break;
	// 		case 2:
	// 			day = "Martes";
	// 			break;
	// 		case 3:
	// 			day = "Miércoles";
	// 			break;
	// 		case 4:
	// 			day = "Jueves";
	// 			break;
	// 		case 5:
	// 			day = "Viernes";
	// 			break;
	// 		case 6:
	// 			day = "Sábado";
	// 			break;
	// 		default:
	// 			day = day;
	// 	}
	// 	if (date < 10) {
	// 		date = "0" + date;
	// 	}
	// 	if (month < 10) {
	// 		month = "0" + month;
	// 	}
	// 	day = day;
	// 	disp_date.innerHTML = date + " / " + month + " / " + year;
	// 	disp_day.innerHTML = day;
	// }
</script>
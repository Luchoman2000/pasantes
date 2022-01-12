<?php
require_once './controller/perfil.controlador.php';
$perfil = new PerfilControlador();
$horario = $perfil->CtrGetHorario();
$Pdata = $perfil->CtrGetDatosPersonales();
$permite_cambio_clave = $perfil->CtrGetCoreConfig('permite_cambio_clave');

// var_dump($Pdper);
?>
<script src="<?php echo SERVERURL ?>src/js/perfil.js"></script>
<div class="card">
	<div class="card-content">
		<div class="container mW alignCenter content">
			<h1 class="title has-text-success">Perfil</h1>
			<p>Revisa o actualiza los datos de tu perfil a continuación:</p>
		</div>
	</div>
</div>

<br>
<br>

<div class="container">
	<div class="box">
		<div class="card-content">
			<div class="content">
				<!-- Perfil de usuario -->
				<?php if ($permite_cambio_clave) :
				?>
					<div class="box">
						<form id="ClaveForm" action="<?php echo SERVERURL ?>ajax/perfil.ajax.php" method="post">
							
							<label class="label has-text-info-dark title is-5 pb-4">Cambiar contraseña</label>
							<div class="columns is-desktop">

								<div class="column">
									<div class="field ">
										<div class="field-label"></div>
										<div class="field-body">
											<div class="field is-expanded">
												<div class="field has-addons">
													<p class="control">
														<a class="button is-static">
															Anterior
														</a>
													</p>
													<p class="control is-expanded">
														<input autocomplete="off" name="anteriorClave" id="anteriorClave" class="input" type="password" placeholder="Clave anterior">
													</p>
												</div>
												<!-- <p class="help">Do not enter the first zero</p> -->
											</div>
										</div>
									</div>
								</div>
								<div class="column">
									<div class="field">
										<div class="field-label"></div>
										<div class="field-body">
											<div class="field is-expanded">
												<div class="field has-addons">
													<p class="control">
														<a class="button is-static">
															Nueva
														</a>
													</p>
													<p class="control is-expanded">
														<input autocomplete="off" name="nuevaClave1" id="nuevaClave1" class="input" type="password" value="" placeholder="Nueva clave">
													</p>
												</div>
												<!-- <p class="help">Do not enter the first zero</p> -->
											</div>
										</div>
									</div>
								</div>
								<div class="column">
									<div class="field">
										<div class="field-label"></div>
										<div class="field-body">
											<div class="field is-expanded">
												<div class="field has-addons">
													<p class="control">
														<a class="button is-static">
															Repetir
														</a>
													</p>
													<p class="control is-expanded">
														<input autocomplete="off" name="nuevaClave2" id="nuevaClave2" class="input" type="password" value="" placeholder="Repita su clave">
													</p>
												</div>
												<!-- <p class="help">Do not enter the first zero</p> -->
											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="columns">
								<div class="column">
									<button type="submit" class="button is-success is-outlined btnCambiarClave">
										<span class="icon">
											<i class="fa fa-save"></i>
										</span>
										<span>Guardar</span>
									</button>

								</div>
							</div>

						</form>
					</div>
					<br>
				<?php endif ?>

				<?php if ($_SESSION['rol'] != 'ADMINISTRADOR' && ($_SESSION['hor_id'] != null || $_SESSION['hor_id'] == 1)) :
				?>
					<div class="box">
						<fieldset disabled="disabled">
							<label class="label has-text-info-dark title is-5 pb-4">Horario</label>

							<div class="columns is-desktop">

								<div class="column">
									<div class="field ">
										<div class="field-label"></div>
										<div class="field-body">
											<div class="field is-expanded">
												<div class="field has-addons">
													<p class="control">
														<a class="button is-static">
															Desde
														</a>
													</p>
													<p class="control is-expanded">
														<input class="input" type="text" value="<?php echo date('H:i a', strtotime($horario['hor_entrada'])) ?>">
													</p>
												</div>
												<!-- <p class="help">Do not enter the first zero</p> -->
											</div>
										</div>
									</div>
								</div>
								<div class="column">


									<div class="field">
										<div class="field-label"></div>
										<div class="field-body">
											<div class="field is-expanded">
												<div class="field has-addons">
													<p class="control">
														<a class="button is-static">
															Hasta
														</a>
													</p>
													<p class="control is-expanded">
														<input class="input" type="text" value="<?php echo date('H:i a', strtotime($horario['hor_salida'])) ?>">
													</p>
												</div>
												<!-- <p class="help">Do not enter the first zero</p> -->
											</div>
										</div>
									</div>
								</div>

							</div>

						</fieldset>
					</div>
				<?php endif ?>

				<br>
				<div class="box">


					<form id="PerfilForm" action="<?php echo SERVERURL ?>ajax/perfil.ajax.php" method="post">


						<label class="label has-text-info-dark title is-5 pb-4">Datos</label>

						<div class="columns">

							<div class="column">
								<div class="field">
									<label class="label">Nombres*</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_pri_nombre'] . ' ' . $Pdata['per_seg_nombre'] ?>" name="uNombres" id="uNombres" class="input" type="text" placeholder="José Luis">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>
							<div class="column">
								<div class="field">
									<label class="label">Apellidos*</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_pri_apellido'] . ' ' . $Pdata['per_seg_apellido'] ?>" name="uApellidos" id="uApellidos" class="input" type="text" placeholder="Pérez López">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>
							</div>
						</div>

						<div class="columns">
							<div class="column">

								<div class="field">
									<label class="label">Cédula*</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_dni'] ?>" name="uCedula" id="uCedula" class="input" type="text" placeholder="1234567890">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>
							<div class="column">

								<div class="field">
									<label class="label">Teléfono / Celular</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_telefono'] ?>" name="uTelefono" id="uTelefono" class="input" type="text" placeholder="0987654321">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>
						</div>

						<div class="columns">
							<div class="column">

								<div class="field">
									<label class="label">Correo</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_correo'] ?>" name="uCorreo" id="uCorreo" class="input" type="email" placeholder="correo@mail.com">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>
							<div class="column">

								<div class="field">
									<label class="label">Fecha de nacimiento</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_fecha_nacimiento'] ?>" name="uFechaNacimiento" class="input" type="date">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>
						</div>
						<div class="columns">
							<div class="column">

								<div class="field">
									<label class="label">Dirección</label>
									<div class="control">
										<input value="<?php echo $Pdata['per_direccion'] ?>" name="uDireccion" id="uDireccion" class="input" type="text" placeholder="Marte, Calle 123">
									</div>
									<!-- <p class="help">This is a help text</p> -->
								</div>

							</div>

						</div>
						<button type="submit" class="button is-success is-outlined btnGuardarPerfil">
							<span class="icon">
								<i class="fa fa-save"></i>
							</span>
							<span>Guardar</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<br>
<br>
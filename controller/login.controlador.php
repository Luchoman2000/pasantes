<?php
if ($peticionAjax) {
	require_once "./../core/mainModel.php";
	require_once "./../core/configGeneral.php";
	require_once "./../model/login.modelo.php";
} else {
	require_once "./core/mainModel.php";
	require_once "./core/configGeneral.php";
	require_once "./model/login.modelo.php";
}
class loginControlador extends LoginModelo
{


	//  Controlador iniciar sesion 
	public function CtrIniciarSesion()
	{
		$usuario = mainModel::limpiar_cadena($_POST['usuario']);
		$clave = mainModel::limpiar_cadena($_POST['clave']);

		// Comprobando campos vacios
		if ($usuario == "" || $clave == "") {
			echo 'campos_vacios';
			exit();
		}
		/*-- Verificando integridad datos */

		// if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
		//     echo '<script>
		// 		Swal.fire({
		// 		  title: "Ocurrió un error inesperado",
		// 		  text: "La contraseña no coincide con el formato solicitado.",
		// 		  icon: "error",
		// 		  confirmButtonText: "Aceptar"
		// 		});
		// 	</script>';
		//     exit();
		// }

		// $clave = mainModel::encryption($clave);

		/*-- Verificando datos de la cuenta --*/

		$datos = [
			'usuario' => $usuario,
			'password' => $clave
		];

		$datos_cuenta = LoginModelo::MdlIniciarSesion($datos);

		if ($datos_cuenta->rowCount() == 1) {
			$row = $datos_cuenta->fetch();
			if (password_verify($datos['password'], $row['usu_clave'])) {
				// $checkSession = LoginModelo::MdlcheckSession($row['usu_id']);
				// $checkSession = $checkSession->fetch();

				// if (@$checkSession['usu_sesion'] && $checkSession['usu_sesion'] != '') {
				// 	echo 'sesion_ya_iniciada';
				// 	exit();
				// }

				// var_dump($checkSession);
				if ($row['estado'] == 1) {



					// session_unset();
					// session_destroy();
					// session_name('SSP');
					@session_start();
					@session_set_cookie_params(60 * 60);

					// if (isset($_SESSION)) {
					// 	$seconds = 60 * 60;
					// 	if ($seconds != 0) {
					// 		$seconds = time() + $seconds;
					// 		setcookie(session_name(), session_id(), $seconds);
					// 	} else {
					// 		setcookie(session_name(), session_id(), 0);
					// 	}
					// } else {
					// 	$cookieParams = session_get_cookie_params();

					// 	session_set_cookie_params(
					// 		$cookieParams["lifetime"],
					// 		$cookieParams["path"],
					// 		$cookieParams["domain"],
					// 		$cookieParams["secure"],
					// 	);
					// }

					$_SESSION['id'] = $row['usu_id'];
					$_SESSION['p_id'] = $row['per_id'];
					$_SESSION['rol'] = $row['rol'];
					$_SESSION['hor_id'] = $row['hor_id'];
					if (@$_SESSION['hor_id'] != 1 && $_SESSION['rol'] != 'ADMINISTRADOR') {
						@$hor = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE hor_id = '" . $_SESSION['hor_id'] . "'");
						if (@$hor->rowCount() >= 1) {
							@$hor = $hor->fetch();
							$_SESSION['horario']['hor_entrada'] = $hor['hor_entrada'];
							$_SESSION['horario']['hor_salida'] = $hor['hor_salida'];
						}
					}
					// $_SESSION['horario']['hor_limite'] = $hor['hor_limite'];
					//make a hash for the session cookie
					$session_cookie = hash('sha256', $row['usu_id'] . $row['usu_usuario'] . $row['usu_clave'] . date('Y-m-d H:i:s'));
					//set the session
					$_SESSION['session'] = $session_cookie;

					//insert the session into the database
					$datos = [
						'usu_id' => $row['usu_id'],
						'session' => $session_cookie
					];
					LoginModelo::MdlInsertSession($datos);

					$_SESSION['nombre'] = $row['per_pri_nombre'];
					$_SESSION['apellido'] = $row['per_pri_apellido'];
					// $_SESSION['usu_nombre'] = $row['usu_nombre'];
					// $_SESSION['usu_dni'] = $row['usu_dni'];

					// if (headers_sent()) {

					//   // echo '<script> window.location.href="' . SERVERURL . 'home"; </script>';
					// } elseif ($_SERVER['HTTP_REFERER'] != SERVERURL && $_SERVER['HTTP_REFERER'] != SERVERURL . 'login') {
					//   // echo SERVERURL;
					//   // echo $_SERVER['HTTP_REFERER'];
					//   echo header("Location:" . $_SERVER['HTTP_REFERER']);
					// } else {
					//   // echo SERVERURL;
					//   // echo $_SERVER['HTTP_REFERER'];
					//   echo header("Location:" . SERVERURL . "home");
					// }
					// echo json_encode($_SESSION);

					// echo ($checkSession['usu_sesion'] && $checkSession['usu_sesion'] != '') ? 'sesion_iniciada_ok' : 'ok';
					echo 'ok';
				} else {
					//   echo '<script>
					//     const Toast = Swal.mixin({
					//         toast: true,
					//         position: "bottom-end",
					//         showConfirmButton: false,
					//         timer: 2000,
					//         timerProgressBar: true,
					//         didOpen: (toast) => {
					//           toast.addEventListener("mouseenter", Swal.stopTimer)
					//           toast.addEventListener("mouseleave", Swal.resumeTimer)
					//         }
					//       })

					//       Toast.fire({
					//         icon: "error",
					//         title: "Usuario inactivo"
					//       })
					// </script>';
					echo 'usuario_inactivo';
				}
			} else {
				if ($usuario == "admin" && $clave == "admin") {
					$m = "No hay admin admin 🤣";
				} else if ($usuario == "user" && $clave == "user") {
					$m = "User User ???";
				} else {
					$m = "Usuario o contraseña incorrectos 🤔";
				}
				// echo '<script>
				//     const Toast = Swal.mixin({
				//         toast: true,
				//         position: "bottom-end",
				//         showConfirmButton: false,
				//         timer: 2000,
				//         timerProgressBar: true,
				//         didOpen: (toast) => {
				//           toast.addEventListener("mouseenter", Swal.stopTimer)
				//           toast.addEventListener("mouseleave", Swal.resumeTimer)
				//         }
				//       })

				//       Toast.fire({
				//         icon: "error",
				//         title: "' . $m . '"
				//       })
				// </script>';
				echo 'error_credenciales';
			}
		} else {
			if ($usuario == "admin" && $clave == "admin") {
				$m = "No hay admin admin 🤣";
			} else if ($usuario == "user" && $clave == "user") {
				$m = "User User ???";
			} else {
				$m = "Usuario o contraseña incorrectos 🤔";
			}
			// echo '<script>
			//       const Toast = Swal.mixin({
			//           toast: true,
			//           position: "bottom-end",
			//           showConfirmButton: false,
			//           timer: 2000,
			//           timerProgressBar: true,
			//           didOpen: (toast) => {
			//             toast.addEventListener("mouseenter", Swal.stopTimer)
			//             toast.addEventListener("mouseleave", Swal.resumeTimer)
			//           }
			//         })

			//         Toast.fire({
			//           icon: "error",
			//           title: "' . $m . '"
			//         })
			// 	</script>';
			echo 'error_credenciales';
		}
	} /*-- Fin controlador - End controller --*/

	//  Controlador cerrar sesion
	public function CtrCerrarSesion()
	{
		if (isset($_SESSION['id']) && isset($_SESSION['p_id']) && isset($_SESSION['rol'])) {
			$sql = LoginModelo::MdlEliminarSession($_SESSION['id']);
			if ($sql->errorCode() == '00000') {
				session_unset();
				session_destroy();
				echo '<script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer)
                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: "success",
                title: "Sesión cerrada correctamente"
              })
        </script>';
			} else {
				echo '<script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer)
                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: "error",
                title: "Ocurrió un error inesperado"
              })
        </script>';
			}

			// echo '<script>

			//               Swal.fire({
			//                 title: "¡Sesión cerrada!",
			//                 text: "¡Hasta pronto!",
			//                 icon: "success",
			//                 confirmButtonText: "Aceptar"
			//               }).then((result) => {
			//                 if (result.value) {
			//                   window.location = "' . SERVERURL . 'login";
			//                 }
			//               });
			//               </script>';
		} else {
			echo '<script>
            alert("Sesión cerrada");
            window.location = "' . SERVERURL . 'login";
        </script>';
		}
	}

	public function CtrPrevenirErrorHorario()
	{
		//Prevencion de eliminación de todos los horarios 
		if (@$_SESSION['hor_id'] == null) {
			$sql = LoginModelo::MdlPrevenirErrorHorario();
			if ($sql->rowCount() == 0) {
				mainModel::ejecutar_consulta_simple("INSERT INTO horario (hor_id, hor_entrada, hor_salida_a, hor_regreso_a, hor_salida) VALUES (1, '00:00:00', '00:00:00', '00:00:00', '00:00:00')");
				$_SESSION['hor_id'] = 1;
			}
		}
	}

	public function CtrBorrarSession()
	{
		$sql = LoginModelo::MdlEliminarSession($_SESSION['id']);
		return $sql;
	}

	public function CtrCerrarSesion_noDB()
	{
		unset($_SESSION["id"]);
		unset($_SESSION["rol"]);
		unset($_SESSION["p_id"]);
		unset($_SESSION["nombre"]);
		unset($_SESSION["apellido"]);
		unset($_SESSION["hor_id"]);
		if (@isset($_SESSION['horario']['hor_entrada']) && @isset($_SESSION['horario']['hor_salida'])) {
			unset($_SESSION['horario']['hor_entrada']);
			unset($_SESSION['horario']['hor_salida']);
		}
		session_unset();
		session_destroy();
	}

	public function CtrVerificarSession()
	{
		$sql = mainModel::ejecutar_consulta_simple("SELECT usu_sesion FROM usuario WHERE usu_sesion = '" . $_SESSION['session'] . "'");
		return $sql;
	}

	// Ramdom funny message
	function msg($msg = '')
	{
		$mensages = [
			'No',
			'Bloquearás tu cuenta 😭',
			'Yaa no te acuerdas 😨',
			'Nadie te ama 😢'
		];
		if ($msg == '') {
			$msg = $mensages[rand(0, count($mensages) - 1)];
		} else if ($msg == 'ad') {
			$msg = $mensages[1];
		} elseif ($msg == 'bloq') {
			$msg = $mensages[2];
		} elseif ($msg == 'yaa') {
			$msg = $mensages[3];
		} elseif ($msg == 'nadie') {
			$msg = $mensages[4];
		}
		return $msg;
	}
}

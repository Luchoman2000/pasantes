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
                        title: "¿Llenaste todos los campos? 🤔"
                      })
				</script>';
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

        /*-- Verificando datos de la cuenta - Verifying account details --*/

        // $datos_cuenta = mainModel::datos_tabla("Normal", "usuario WHERE usuario_usuario='$usuario' AND 	usuario_clave='$clave' ", "*", 0);
        // $datos_cuenta = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_administrador WHERE usu_usuario ='$usuario' AND  usu_clave = '$clave'");
        $datos = [
            'usuario' => $usuario,
            'password' => $clave
        ];
        $datos_cuenta = LoginModelo::MdlIniciarSesion($datos);

        if ($datos_cuenta->rowCount() == 1) {
            session_name('SSP');
            session_start();
            $row = $datos_cuenta->fetch();
            $_SESSION['id'] = $row['usu_id'];
            $_SESSION['p_id'] = $row['per_id'];
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['nombre'] = $row['per_pri_nombre'];
            $_SESSION['apellido'] = $row['per_pri_apellido'];
            // $_SESSION['usu_nombre'] = $row['usu_nombre'];
            // $_SESSION['usu_dni'] = $row['usu_dni'];

            if (headers_sent()) {

                // echo '<script> window.location.href="' . SERVERURL . 'home"; </script>';
            } elseif($_SERVER['HTTP_REFERER'] != SERVERURL && $_SERVER['HTTP_REFERER'] != SERVERURL . 'login') {
                echo SERVERURL;
                echo $_SERVER['HTTP_REFERER'];
                echo header("Location:" . $_SERVER['HTTP_REFERER']);
            }else{
                echo SERVERURL;
                echo $_SERVER['HTTP_REFERER'];
                echo header("Location:" .SERVERURL . "home");
                
            }
            // $url = SERVERURL . "admin/home/";
            // echo $url;
            // echo $_SESSION['adm_nombre'];
            // return $urllocation = '<script> window.location = "'.$url.'"</script>';
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
                title: "Usuario o clave incorrectos 😧"
              })
				</script>';
        }
    } /*-- Fin controlador - End controller --*/

    //  Controlador cerrar sesion
    public function CtrCerrarSesion()
    {
        if (isset($_SESSION['id'])) {
            session_unset();
            session_destroy();
            echo '<script>
                    
                    Swal.fire({
                      title: "¡Sesión cerrada!",
                      text: "¡Hasta pronto!",
                      icon: "success",
                      confirmButtonText: "Aceptar"
                    }).then((result) => {
                      if (result.value) {
                        window.location = "'.SERVERURL.'login";
                      }
                    });
                    </script>';
        } else {
            echo '<script>
            alert("Sesión cerrada");
            window.location = "'.SERVERURL.'login";
        </script>';
        }
    }

}

<?php
if ($peticionAjax) {
    require_once "./../model/admin.modelo.php";
} else {
    require_once "./model/admin.modelo.php";
}
class AdminControlador extends AdminModelo
{

    //Para mostrar los usuarios
    public function CtrMostrarUsuarios()
    {
        $sql = mainModel::ejecutar_consulta_simple("SELECT u.*,r.rol_nombre as rol, r.rol_id as rol_id,
        CONCAT(p.per_pri_nombre, ' ', p.per_seg_nombre, ' ', p.per_pri_apellido, ' ', p.per_seg_apellido) AS nombre 
        FROM usuario u
        INNER JOIN personal p ON u.per_id = p.per_id
        INNER JOIN rol r ON u.rol_id = r.rol_id");

        $tabla = '
            <table id="listaUsuarios" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Clave</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
            <tbody>
        ';

        if ($sql->rowCount() > 0) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $nombre = strtolower($row['nombre']);
                $nombre = ucwords($nombre);
                $tabla .= '
                    <tr>
                        <td style="vertical-align: middle;">' . $nombre . '</td>
                        <td style="vertical-align: middle;">' . $row['usu_usuario'] . '</td>
                        <td style="vertical-align: middle;">' . $row['usu_clave'] . '</td>';
                if ($row['usu_estado'] == 1) {
                    $tabla .= '
                        <td style="vertical-align: middle;">Activo</td>';
                } else {
                    $tabla .= '
                        <td style="vertical-align: middle;">Inactivo</td>';
                }

                $tabla .= '<td style="vertical-align: middle;">' . $row['rol'] . '</td>
                        <td style="vertical-align: middle; text-align: center;">
                            <button estado="' . $row['usu_estado'] . '"  rol="' . mainModel::encryption($row['rol_id']) . '" id="' . mainModel::encryption($row['usu_id']) . '" style="height: fit-content;" class="button is-success is-outlined editarUsuario modal-button"  data-target="usuarioForm" data-toggle="modal">
                                <span class="icon">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                            </button>
                            <button id="' . mainModel::encryption($row['usu_id']) . '" style="height: fit-content;" class="button is-danger is-outlined eliminarUsuario">
                                <span class="icon">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </span>
                            </button>
                        </td>
                    </tr>';
            }
        } else {
            $tabla .= '
                <tr>
                    <td colspan="5" style="text-align:center;">No hay usuarios 😥</td>
                </tr>
            ';
        }
        $tabla .= '
                </tbody>
            </table>';
        echo $tabla;
    }

    //Para mostrar el personal
    public function CtrMostrarPersonal()
    {
        $sql = mainModel::ejecutar_consulta_simple("SELECT p.*,
        CONCAT(per_pri_nombre, ' ', per_seg_nombre, ' ', per_pri_apellido, ' ', per_seg_apellido) AS nombre 
        FROM personal p");

        $tabla = '
            <table id="listaPersonal" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha de nacimiento</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
            <tbody>
        ';
        if ($sql->rowCount() > 0) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $nombre = strtolower($row['nombre']);
                $nombre = ucwords($nombre);
                $tabla .= '
                        <tr>
                            <td style="vertical-align: middle;">' . $nombre . '</td>
                            <td style="vertical-align: middle;">' . $row['per_dni'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_telefono'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_correo'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_fecha_nacimiento'] . '</td>';
                if ($row['per_estado'] == 1) {
                    $tabla .= '
                            <td style="vertical-align: middle;">Activo</td>';
                } else {
                    $tabla .= '
                            <td style="vertical-align: middle;">Inactivo</td>';
                }

                $tabla .= '<td style="vertical-align: middle; text-align: center;">
                                <button estado="' . $row['per_estado'] . '"  id="' . mainModel::encryption($row['per_id']) . '" style="height: fit-content;" class="button is-success is-outlined editarPersonal modal-button"  data-target="personalForm" data-toggle="modal">
                                    <span class="icon">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                </button>
                                <button id="' . mainModel::encryption($row['per_id']) . '" style="height: fit-content;" class="button is-danger is-outlined eliminarPersonal">
                                    <span class="icon">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>';
            }
        }else {
            $tabla .= '
                <tr>
                    <td colspan="6" style="text-align:center;">No hay personal 😥</td>
                </tr>
            ';
        }
        $tabla .= '
                </tbody>
            </table>';
        echo $tabla;
    }


    //Para eliminar usuarios
    public function CtrEliminarUsuario()
    {
        if (isset($_POST['id'])) {
            $idUsuario = mainModel::decryption($_POST['id']);
            $sql = mainModel::ejecutar_consulta_simple("DELETE FROM usuario WHERE usu_id = $idUsuario");
            if ($sql->rowCount() > 0) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "error";
        }
        echo $res;
    }

    //Para eliminar personal
    public function CtrEliminarPersonal()
    {
        if (isset($_POST['id_personal'])) {
            $idPersonal = mainModel::decryption($_POST['id_personal']);
            $sql = mainModel::ejecutar_consulta_simple("DELETE FROM personal WHERE per_id = $idPersonal");
            if ($sql->rowCount() > 0) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "error";
        }
        echo $res;
    }

    //Para editar usuarios
    public function CtrEditarUsuario()
    {
        $idUsuario = mainModel::decryption($_POST['id_usuario']);
        $idPersonal = mainModel::decryption($_POST['uPersonal']);
        $usuario = mainModel::limpiar_cadena($_POST['uUsuario']);
        $idRol = mainModel::decryption($_POST['uRol']);
        $estado = mainModel::limpiar_cadena($_POST['uEstado']);
        $isEditPass = false;

        $datos = [
            "idUsuario" => $idUsuario,
            "idPersonal" => $idPersonal,
            "usuario" => $usuario,
            "idRol" => $idRol,
            "estado" => $estado,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_usuario = '$usuario' AND usu_id != $idUsuario");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {



            if ((isset($_POST['uNClave']) && isset($_POST['uSNClave'])) && ($_POST['uNClave'] != "" && $_POST['uSNClave'] != "")) {
                $clave = mainModel::limpiar_cadena($_POST['uNClave']);
                $clave2 = mainModel::limpiar_cadena($_POST['uSNClave']);
                $datos['clave'] = $clave;
                $datos['clave2'] = $clave2;
                $isEditPass = true;
            }
            // var_dump($datos);


            $sql = AdminModelo::MdlEditarUsuario($datos, $isEditPass);
            // var_dump($sql);
            // var_dump($sql->errorCode());
            if ($sql->errorCode() == "00000") {
                $res = 1;
            } else {
                $res = 0;
            }
            // if ($sql->rowCount() > 0) {
            //     $res = 1;
            // } else {
            //     $res = 0;
            // }
        }
        echo $res;
    }

    //Para editar personal
    public function CtrEditarPersonal()
    {
        $idPersonal = mainModel::decryption($_POST['id_personal']);
        $nombre = mainModel::limpiar_cadena($_POST['pNombre']);
        $nombre2 = isset($_POST['pNombre2']) ? mainModel::limpiar_cadena($_POST['pNombre2']) : "";
        $apellido = mainModel::limpiar_cadena($_POST['pApellido']);
        $apellido2 = isset($_POST['pApellido2']) ? mainModel::limpiar_cadena($_POST['pApellido2']) : "";
        $dni = mainModel::limpiar_cadena($_POST['pCedula']);
        $telefono = isset($_POST['pTelefono']) ? mainModel::limpiar_cadena($_POST['pTelefono']) : "";
        $email = isset($_POST['pEmail']) ? mainModel::limpiar_cadena($_POST['pEmail']) : "";
        $fechaNacimiento = isset($_POST['pFechaNacimiento']) ? mainModel::limpiar_cadena($_POST['pFechaNacimiento']) : "1000-01-01";
        $estado = mainModel::limpiar_cadena($_POST['pEstado']);

        $datos = [
            "idPersonal" => $idPersonal,
            "nombre" => $nombre,
            "nombre2" => $nombre2,
            "apellido" => $apellido,
            "apellido2" => $apellido2,
            "dni" => $dni,
            "telefono" => $telefono,
            "email" => $email,
            "fechaNacimiento" => $fechaNacimiento,
            "estado" => $estado,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM personal WHERE per_dni = '$dni' AND per_id != $idPersonal");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlEditarPersonal($datos);
            if ($sql->errorCode() == "00000") {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para crear usuarios
    public function CtrCrearUsuario()
    {
        $idPersonal = mainModel::decryption($_POST['uPersonal']);
        $usuario = mainModel::limpiar_cadena($_POST['uUsuario']);
        $idRol = mainModel::decryption($_POST['uRol']);
        $estado = mainModel::limpiar_cadena($_POST['uEstado']);
        $clave = mainModel::limpiar_cadena($_POST['uNClave']);
        $clave2 = mainModel::limpiar_cadena($_POST['uSNClave']);

        $datos = [
            "idPersonal" => $idPersonal,
            "usuario" => $usuario,
            "idRol" => $idRol,
            "estado" => $estado,
            "clave" => $clave,
            "clave2" => $clave2,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_usuario = '$usuario'");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlCrearUsuario($datos);
            if ($sql->rowCount() > 0) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para crear personal
    public function CtrCrearPersonal()
    {
        $nombre = mainModel::limpiar_cadena($_POST['pNombre']);
        $nombre2 = isset($_POST['pNombre2']) ? mainModel::limpiar_cadena($_POST['pNombre2']) : "";
        $apellido = mainModel::limpiar_cadena($_POST['pApellido']);
        $apellido2 = isset($_POST['pApellido2']) ? mainModel::limpiar_cadena($_POST['pApellido2']) : "";
        $dni = mainModel::limpiar_cadena($_POST['pCedula']);
        $telefono = isset($_POST['pTelefono']) ? mainModel::limpiar_cadena($_POST['pTelefono']) : "";
        $email = isset($_POST['pEmail']) ? mainModel::limpiar_cadena($_POST['pEmail']) : "";
        $fechaNacimiento = isset($_POST['pFechaNacimiento']) ? mainModel::limpiar_cadena($_POST['pFechaNacimiento']) : "1000-01-01";
        $estado = mainModel::limpiar_cadena($_POST['pEstado']);

        // 

        $datos = [
            "nombre" => $nombre,
            "nombre2" => $nombre2,
            "apellido" => $apellido,
            "apellido2" => $apellido2,
            "dni" => $dni,
            "telefono" => $telefono,
            // "direccion" => $direccion,
            "email" => $email,
            "fechaNacimiento" => $fechaNacimiento,
            "estado" => $estado,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM personal WHERE per_dni = '$dni'");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlCrearPersonal($datos);
            if ($sql->rowCount() > 0) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para mostrar personal para <select>
    public function CtrMostrarPersonalSelect()
    {
        $select = '';
        $sql = mainModel::ejecutar_consulta_simple("SELECT u.*, p.* FROM usuario u RIGHT JOIN personal p ON u.per_id = p.per_id");
        if (isset($_POST['Uid'])) {
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    if ($row['usu_id'] == $id) {
                        $select .= '<option value="' . mainModel::encryption($row['per_id']) . '"';
                        if (isset($_POST['editar_usuario_select_personal'])) {
                            if ($row['usu_id'] == $id) {
                                $select .= 'selected';
                            }
                        }
                        $select .= '>' . $row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido'] . '</option>';
                    }
                    if (is_null($row['usu_id'])) {
                    }
                }

                // foreach ($datos as $row) {
                //     $select .= '
                //         <option value="' . mainModel::encryption($row['per_id']) . '">' . $row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido'] . '</option>
                //     ';
                // }
            }
        } else {
            if ($sql->rowCount() > 0) {
                $select = '
                <option value="">Seleccione un personal</option>
                ';

                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    if (is_null($row['usu_id'])) {
                        # code...

                        $select .= '
                        <option value="' . mainModel::encryption($row['per_id']) . '">' . $row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido'] . '</option>
                    ';
                    } else {
                        $select = '
                            <option value="">No hay personal disponible</option>
                        ';
                    }
                }
            }
        }


        echo $select;
    }

    //Para mostrar rol para <select>
    public function CtrMostrarRolSelect()
    {
        $select = '';
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM rol");
        if (isset($_POST['Uid'])) {
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '<option value="' . mainModel::encryption($row['rol_id']) . '"';
                    if (isset($_POST['editar_usuario_select_rol'])) {
                        if ($row['rol_id'] == $id) {
                            $select .= 'selected';
                        }
                    }
                    $select .= '>' . $row['rol_nombre'] . '</option>';
                }
            }
        } else {
            $select = '
                <option value="">Seleccione un rol</option>
            ';
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '
                        <option value="' . mainModel::encryption($row['rol_id']) . '">' . $row['rol_nombre'] . '</option>
                    ';
                }
            }
        }

        echo $select;
    }

    //Para mostrar estado para <select>
    public function CtrMostrarEstadoSelect()
    {
        $select = '';
        $id_u = mainModel::decryption($_POST['Uid']);
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_id='$id_u'");
        if (isset($_POST['Uid'])) {
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '<option value="' . mainModel::encryption($row['usu_estado']) . '"';
                    if (isset($_POST['editar_usuario_select_estado'])) {
                        if ($row['usu_id'] == $id) {
                            $select .= 'selected';
                        }
                    }
                    $select .= '>' . $row['usu_estado'] . '</option>';
                }
            }
        } else {
            $select = '
                <option value="">Seleccione un estado</option>
            ';
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '
                        <option value="' . mainModel::encryption($row['usu_estado']) . '">' . $row['usu_estado'] . '</option>
                    ';
                }
            }
        }

        echo $select;
    }
}

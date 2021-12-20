<?php
if (@$PeticionAjax) {
    require_once "./../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class LoginModelo extends mainModel
{

    
    protected function MdlIniciarSesion($datos)
    {


        // $pass = password_hash($datos['password'], PASSWORD_DEFAULT);
        $pass = $datos['password'];

        // $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usu_usuario = :usuario AND usu_clave = :password");
        $sql = mainModel::conectar()->prepare("SELECT u.hor_id,  p.*, u.usu_usuario, u.usu_clave, u.usu_id, u.usu_estado AS estado, r.rol_nombre AS rol 
        FROM usuario AS u
        INNER JOIN rol AS r ON u.rol_id = r.rol_id
        INNER JOIN personal AS p ON u.per_id = p.per_id
        WHERE usu_usuario = :usuario 
        ");
        $sql->bindParam(":usuario", $datos['usuario']);
        // $sql->bindParam(":password", $pass);
        $sql->execute();
        return $sql;
        // $sql->close();
        $sql = null;
    }


}

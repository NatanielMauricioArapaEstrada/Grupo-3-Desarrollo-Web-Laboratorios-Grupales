<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = $_POST['nivel'];
$estado = $_POST['estado'];

"SELECT id, correo, password, nombre, nivel, estado FROM usuario";

$sql="UPDATE usuario SET nombre='$nombre', correo='$correo', password='$password', nivel='$nivel', estado='$estado' WHERE id=$id";
$resultado=$con->query($sql);

if($resultado)
{
    ?>
    <span>Registro actualizado correctamente</span>
    <?php
} else {
    echo "Error al actualizar";
}
<?php
include('conexion.php');

$id = $_POST['id'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = $_POST['nivel'];


"SELECT id, correo, password, nivel FROM usuarios";

$sql="UPDATE usuarios SET correo='$correo', password='$password', nivel='$nivel' WHERE id=$id";
$resultado=$con->query($sql);

if($resultado)
{
    ?>
    <span>Registro actualizado correctamente</span>
    <?php
} else {
    echo "Error al actualizar";
}
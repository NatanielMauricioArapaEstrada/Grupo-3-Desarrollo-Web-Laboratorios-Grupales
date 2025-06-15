<?php
include('conexion.php');

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = $_POST['nivel'];
$estado = $_POST['estado'];

$sql = "SELECT id, nombre, correo, password, nivel, estado FROM usuario";

$sql = "INSERT INTO usuario(nombre, correo, password, nivel, estado) VALUE ('$nombre', '$correo', '$password', '$nivel', '$estado')";
$resultado = $con->query($sql);

if($resultado)
{
    ?>
    <span>Creado correctamente</span>
    <?php
} else {
    echo "Error al crear";
}
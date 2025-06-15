<?php
include('conexion.php');


$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$nivel = $_POST['nivel'];


$sql = "SELECT id, correo, password, nivel, FROM usuarios";

$sql = "INSERT INTO usuarios( correo, password, nivel) VALUE ( '$correo', '$password', '$nivel')";
$resultado = $con->query($sql);

if($resultado)
{
    ?>
    <span>Creado correctamente</span>
    <?php
} else {
    echo "Error al crear";
}
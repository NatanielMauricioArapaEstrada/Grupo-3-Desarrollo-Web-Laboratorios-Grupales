<?php 
include('conexion.php');

$numero = $_POST['numero'];
$piso = $_POST['piso'];
$id_tipohabitacion = $_POST['tipoHabitacion'];

$sql = "INSERT INTO habitaciones (numero, piso, id_tipohabitacion) VALUES ('$numero', '$piso', '$id_tipohabitacion')";

$con->query($sql);

echo "Registro insertado correctamente.";


?>
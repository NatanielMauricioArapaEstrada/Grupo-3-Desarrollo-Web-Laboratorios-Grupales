<?php 
include('conexion.php');

$id = $_POST['id'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$id_tipohabitacion = $_POST['tipoHabitacion'];

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$estado = $_POST['estado'];
$id_tipohabitacion = $_POST['tipoHabitacion'];
$id_imagen = $_POST['imagen'];

$sql = "UPDATE habitaciones 
            SET descripcion='$descripcion', numero='$numero', piso='$piso', estado='$estado', 
                id_tipohabitacion='$id_tipohabitacion', id_imagen='$id_imagen' 
            WHERE id=$id";
$con->query($sql);

?>
<?php
include("conexion.php");

$id = $_POST['id'];
$id_destinatario = $_POST['id_destinatario'];
$asunto = $_POST['asunto'];
$descripcion = $_POST['descripcion'];
$estado = $_POST['estado']; // puede ser 'borrador' o 'no_leido'

$sql = "UPDATE mensajes SET id_destinatario=?, asunto=?, descripcion=?, estado=? WHERE id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("isssi", $id_destinatario, $asunto, $descripcion, $estado, $id);
$stmt->execute();

echo "ok";

<?php
include("conexion.php");

$id = $_POST['id'];

$sql = "UPDATE mensajes SET estado = 'enviado' WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo "ok";

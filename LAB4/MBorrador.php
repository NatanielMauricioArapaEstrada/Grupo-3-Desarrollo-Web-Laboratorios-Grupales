<?php
include("conexion.php");

$id = $_GET['id'];
$sql = "SELECT id, id_destinatario, asunto, descripcion FROM mensajes WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$mensaje = $resultado->fetch_assoc();

echo json_encode($mensaje);

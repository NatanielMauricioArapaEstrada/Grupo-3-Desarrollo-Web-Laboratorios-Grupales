<?php
include("conexion.php");
$id = $_GET['id'];

$sql = "SELECT m.asunto, m.descripcion, m.estado, u.nombre, u.correo 
        FROM mensajes m
        INNER JOIN usuario u ON m.id_destinatario = u.id
        WHERE m.id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode([
  'tipo' => 'salida',
  'asunto' => $result['asunto'],
  'descripcion' => $result['descripcion'],
  'estado' => $result['estado'],
  'nombre' => $result['nombre'],
  'correo' => $result['correo']
]);

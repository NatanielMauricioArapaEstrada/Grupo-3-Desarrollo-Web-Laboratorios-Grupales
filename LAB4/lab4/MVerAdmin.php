<?php
include("conexion.php");
session_start();
require("verificarsesion.php");
require("verificarnivel.php");

$id = $_GET['id'] ?? 0;

$sql = "SELECT m.asunto, m.descripcion, m.estado, 
               u1.nombre AS remitente, u1.correo AS correo_remitente,
               u2.nombre AS destinatario, u2.correo AS correo_destinatario
        FROM mensajes m
        JOIN usuario u1 ON m.id_remitente = u1.id
        JOIN usuario u2 ON m.id_destinatario = u2.id
        WHERE m.id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);

<?php
include("conexion.php");
session_start();

$id_remitente = $_SESSION['id_usuario'];
$mensaje = $_POST['mensaje'];
$estado = "borrador"; // Siempre será "borrador"
$asunto = $_POST['asunto']; // Ahora toma el asunto correctamente
$id_destinatario = $_POST["id_destinatario"]; // Ahora toma el destinatario correctamente

$sql = "INSERT INTO mensajes (id_remitente, id_destinatario, descripcion, estado, asunto) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("iisss", $id_remitente, $id_destinatario, $mensaje, $estado, $asunto);

if ($stmt->execute()) {
    echo "Mensaje guardado como borrador.";
} else {
    echo "Error al guardar el borrador.";
}
?>
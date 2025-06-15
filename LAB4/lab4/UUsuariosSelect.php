<?php
include("conexion.php");
session_start();
$id_remitente = $_SESSION['id_usuario'];
$sql = "SELECT id, nombre FROM usuario WHERE estado = 1 AND id != ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_remitente);
$stmt->execute();
$resultado = $stmt->get_result();

while ($fila = $resultado->fetch_assoc()) {
    echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
}
?>

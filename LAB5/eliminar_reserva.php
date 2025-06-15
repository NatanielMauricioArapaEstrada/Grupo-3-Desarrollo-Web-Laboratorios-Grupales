<?php
session_start();
include("conexion.php");

$id_reserva = $_POST['id_reserva'];
$id_habitacion = $_POST['id_habitacion'];
$id_usuario = $_SESSION['id_usuario'] ?? 0;


$sqlDel = "DELETE FROM reservas WHERE id = ? AND id_usuarios = ?";
$stmtDel = $con->prepare($sqlDel);
$stmtDel->bind_param("ii", $id_reserva, $id_usuario);
$stmtDel->execute();


$sqlLib = "UPDATE habitaciones SET estado = 0 WHERE id = ?";
$stmtLib = $con->prepare($sqlLib);
$stmtLib->bind_param("i", $id_habitacion);
$stmtLib->execute();

echo '<div style="text-align:center;">
        <h3>Reserva eliminada correctamente</h3>
        <button onclick="cerrarModal(event, \'modal-global\')">Cerrar</button>
      </div>';
?>

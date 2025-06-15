<?php
session_start();
include("conexion.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reserva = $_POST['id_reserva'];
    $id_usuario = $_SESSION['id_usuario'];
    $id_habitacion_nueva = $_POST['id_habitacion'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_salida = $_POST['fecha_salida'];

  
    $sqlAnt = "SELECT id_habitaciones FROM reservas WHERE id = ? AND id_usuarios = ?";
    $stmtAnt = $con->prepare($sqlAnt);
    $stmtAnt->bind_param("ii", $id_reserva, $id_usuario);
    $stmtAnt->execute();
    $resAnt = $stmtAnt->get_result()->fetch_assoc();
    $id_habitacion_anterior = $resAnt['id_habitaciones'];

  
    $liberar = $con->prepare("UPDATE habitaciones SET estado = 0 WHERE id = ?");
    $liberar->bind_param("i", $id_habitacion_anterior);
    $liberar->execute();

  
    $ocupar = $con->prepare("UPDATE habitaciones SET estado = 1 WHERE id = ?");
    $ocupar->bind_param("i", $id_habitacion_nueva);
    $ocupar->execute();

    
    $sqlUpdate = "UPDATE reservas SET id_habitaciones = ?, fecha_ingreso = ?, fecha_salida = ?, estado = 'pendiente' WHERE id = ? AND id_usuarios = ?";
    $stmtUpd = $con->prepare($sqlUpdate);
    $stmtUpd->bind_param("sssii", $id_habitacion_nueva, $fecha_ingreso, $fecha_salida, $id_reserva, $id_usuario);

    if ($stmtUpd->execute()) {
        echo '<div style="text-align:center;">
                <h3>Reserva actualizada correctamente</h3>
                <button onclick="cerrarModal(event, \'modal-global\'); cargarContenido(\'misReservas.php\')">Cerrar</button>
              </div>';
    } else {
        echo '<div style="text-align:center;">
                <h3>Error al actualizar la reserva</h3>
                <button onclick="cerrarModal(event, \'modal-global\')">Cerrar</button>
              </div>';
    }
    exit;
}
?>

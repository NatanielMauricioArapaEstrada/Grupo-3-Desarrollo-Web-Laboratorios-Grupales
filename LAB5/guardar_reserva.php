<?php
session_start();
include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];
$id_habitacion = $_POST['id_habitacion'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_salida = $_POST['fecha_salida'];

$sql = "INSERT INTO reservas (id_usuarios, id_habitaciones, fecha_ingreso, fecha_salida, estado) 
        VALUES (?, ?, ?, ?, 'activo')";
$stmt = $con->prepare($sql);
$stmt->bind_param("iiss", $id_usuario, $id_habitacion, $fecha_ingreso, $fecha_salida);

if ($stmt->execute()) {

    $update = $con->prepare("UPDATE habitaciones SET estado = 1 WHERE id = ?");
    $update->bind_param("i", $id_habitacion);
    $update->execute();

    echo '
    <div >
        <h3>Reserva exitosa</h3>
        <p>Tu reserva ha sido registrada con éxito.</p>
        <button onclick="cerrarModal(event, \'modal-global\')">Cerrar</button>
    </div>';
} else {
    echo '
    <div>
        <h3>Error</h3>
        <p>No se pudo completar la reserva. Intenta más tarde.</p>
        <button onclick="cerrarModal(event, \'modal-global\')">Cerrar</button>
    </div>';
}
?>

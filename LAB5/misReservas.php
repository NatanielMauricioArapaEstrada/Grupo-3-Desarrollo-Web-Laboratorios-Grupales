<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    echo "<p>Debes iniciar sesión para ver tus reservas.</p>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];


$sql = "SELECT 
            r.id AS id_reserva,
            r.fecha_ingreso,
            r.fecha_salida,
            r.estado AS estado_reserva,
            h.numero,
            h.piso,
            h.id AS id_habitacion,
            th.nombre AS tipo_nombre,
            th.nrocamas,
            ih.imagen
        FROM reservas r
        INNER JOIN habitaciones h ON r.id_habitaciones = h.id
        INNER JOIN tipohabitacion th ON h.id_tipohabitacion = th.id
        LEFT JOIN imageneshabitaciones ih ON h.id_imagen = ih.id
        WHERE r.id_usuarios = ?
        ORDER BY r.fecha_ingreso ASC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$reservas = $stmt->get_result();

if ($reservas->num_rows > 0) {
    echo '<table border="1" cellpadding="8" cellspacing="0">';
    echo '<tr>
            <th>Imagen</th>
            <th>Tipo</th>
            <th>Piso</th>
            <th>Número</th>
            <th>Nro Camas</th>
            <th>Ingreso</th>
            <th>Salida</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Cancelar</th>
        </tr>';

    while ($fila = $reservas->fetch_assoc()) {
    echo '<tr>
        <td><img src="imagenes/' . $fila['imagen'] . '" width="100"></td>
        <td>' . $fila['tipo_nombre'] . '</td>
        <td>' . $fila['piso'] . '</td>
        <td>' . $fila['numero'] . '</td>
        <td>' . $fila['nrocamas'] . '</td>
        <td>' . $fila['fecha_ingreso'] . '</td>
        <td>' . $fila['fecha_salida'] . '</td>
        <td>' . $fila['estado_reserva'] . '</td>
        <td><button onclick="editarReserva(' . $fila['id_reserva'] . ')">Editar</button></td>
        <td><button onclick="cancelarReserva(' . $fila['id_reserva'] . ', ' . $fila['id_habitacion'] . ')">Cancelar</button></td>
    </tr>';
}

    echo '</table>';
} else {
    echo "<p>No tienes reservas registradas.</p>";
}
?>

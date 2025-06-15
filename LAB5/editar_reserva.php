<?php
session_start();
include("conexion.php");

$id_reserva = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];


$sql = "SELECT r.id, r.id_habitaciones, r.fecha_ingreso, r.fecha_salida, h.piso, h.numero, h.id_tipohabitacion
        FROM reservas r
        INNER JOIN habitaciones h ON r.id_habitaciones = h.id
        WHERE r.id = ? AND r.id_usuarios = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $id_reserva, $id_usuario);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo "<p>No se encontró la reserva.</p>";
    exit;
}
$reserva = $res->fetch_assoc();


$sqlHab = "SELECT h.id, h.numero, th.nombre as tipo
           FROM habitaciones h
           INNER JOIN tipohabitacion th ON h.id_tipohabitacion = th.id
           WHERE h.estado = 0";
$resHab = $con->query($sqlHab);
?>

<h3>Editar Reserva</h3>
<form onsubmit="guardarCambiosReserva(event, <?php echo $id_reserva; ?>)">
    <label>Habitación disponible:</label><br>
    <select name="id_habitacion" required>
        <option value="">Seleccione</option>
        <?php while($h = $resHab->fetch_assoc()): ?>
            <option value="<?php echo $h['id']; ?>" <?php if ($h['id'] == $reserva['id_habitaciones']) echo 'selected'; ?>>
                <?php echo $h['tipo'] . ' - Nro ' . $h['numero']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Fecha de ingreso:</label><br>
    <input type="date" name="fecha_ingreso" value="<?php echo $reserva['fecha_ingreso']; ?>" required><br><br>

    <label>Fecha de salida:</label><br>
    <input type="date" name="fecha_salida" value="<?php echo $reserva['fecha_salida']; ?>" required><br><br>

    <button type="submit">Reservar</button>
    <button onclick="eliminarReserva(event, <?php echo $id_reserva; ?>)">Eliminar Reserva</button>
    <button onclick="cerrarModal(event, 'modal-global')">Cancelar</button>
</form>

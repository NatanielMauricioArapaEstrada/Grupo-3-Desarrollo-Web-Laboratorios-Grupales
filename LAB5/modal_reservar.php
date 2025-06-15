<?php
$id = $_GET['id'];
?>

<form onsubmit="confirmarReserva(event, <?php echo $id; ?>)">
    <h3>Reservar habitación</h3>

    <label for="fecha_ingreso">Fecha de ingreso:</label><br>
    <input type="date" name="fecha_ingreso" required><br><br>

    <label for="fecha_salida">Fecha de salida:</label><br>
    <input type="date" name="fecha_salida" required><br><br>

    <button type="submit">Confirmar Reserva</button>
    <button onclick="cerrarModal(event, 'modal-global')">Cancelar</button>
</form>

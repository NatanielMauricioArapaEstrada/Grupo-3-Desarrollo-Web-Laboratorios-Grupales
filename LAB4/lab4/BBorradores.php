<?php
include('conexion.php');
session_start();

$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener los borradores del usuario
$sql = "SELECT id, asunto, estado 
        FROM mensajes 
        WHERE id_remitente = ? AND estado = 'borrador'";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<h2>Borradores</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Operación</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $fila['asunto'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td>
                <button onclick="abrir_modal_borrador(<?= $fila['id'] ?>)">Ver</button>
                <button style=" background-color: #d63d3d;" onclick="eliminarMensaje('BBorradores.php',<?= $fila['id'] ?>)">Eliminar</button>
            </td>
        </tr>
    <?php } ?>
</table>

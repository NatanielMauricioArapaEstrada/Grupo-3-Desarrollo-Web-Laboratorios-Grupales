<?php
include('conexion.php');
session_start();

// Obtener ID del usuario que inició sesión
$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener los mensajes enviados por el usuario
$sql = "SELECT m.id, u.correo AS destinatario, m.asunto, m.estado 
        FROM mensajes m
        LEFT JOIN usuario u ON m.id_destinatario = u.id
        WHERE m.id_remitente = ? AND m.estado !='borrador'";
        
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<h2>Mensajes enviados</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Destinatario</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Operación</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $fila['destinatario'] ?? 'Sin destinatario' ?></td>
            <td><?= $fila['asunto'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td>
                <button onclick="abrir_modal_mensaje_ver('salida', <?= $fila['id'] ?>)">Ver</button>
                <button style=" background-color: #d63d3d;" onclick="eliminarMensaje('BSalida.php',<?= $fila['id'] ?>)">Eliminar</button>
            </td>
        </tr>
    <?php } ?>
</table>

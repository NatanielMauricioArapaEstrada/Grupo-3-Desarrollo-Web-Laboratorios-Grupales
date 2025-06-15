<?php
include("conexion.php");
session_start();

$id_usuario = $_SESSION['id_usuario']; // El que inició sesión

$sql = "SELECT u.correo,m.id , m.asunto, m.estado 
        FROM mensajes m
        JOIN usuario u ON m.id_remitente = u.id
        WHERE m.id_destinatario = ? AND m.estado !='borrador'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<table border="1">
    <tr>
        <th>Correo</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Operación</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr id="fila-<?= $fila['id'] ?>" class="<?= $fila['estado'] === 'no_leido' ? 'fila-no-leido' : '' ?>">
            <td><?= htmlspecialchars($fila['correo']) ?></td>
            <td><?= htmlspecialchars($fila['asunto']) ?></td>
            <td><?= $fila['estado'] ?></td>
            <td>
                <button onclick="abrir_modal_mensaje_ver('entrada', <?= $fila['id'] ?>)">Ver</button>
                <button style=" background-color: #d63d3d;" onclick="eliminarMensaje( 'BEntrada.php'  ,<?= $fila['id'] ?>)">Eliminar</button>
            </td>
        </tr>
    <?php } ?>
</table>

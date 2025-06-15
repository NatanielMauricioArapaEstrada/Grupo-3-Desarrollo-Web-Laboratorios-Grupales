<?php
session_start();
require("verificarsesion.php");
require("verificarnivel.php"); 

include("conexion.php");

$sql = "SELECT m.id, 
               u1.nombre AS remitente, 
               u2.nombre AS destinatario, 
               m.asunto, 
               m.descripcion, 
               m.estado
        FROM mensajes m
        JOIN usuario u1 ON m.id_remitente = u1.id
        JOIN usuario u2 ON m.id_destinatario = u2.id
        WHERE m.estado != 'borrador'
        ORDER BY m.id DESC";

$resultado = $con->query($sql);
?>

<h3>Todos los correos existentes entre usuarios</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Remitente</th>
            <th>Destinatario</th>
            <th>Asunto</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Operación</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['remitente']; ?></td>
                <td><?php echo $row['destinatario']; ?></td>
                <td><?php echo $row['asunto']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td>  <button onclick="abrir_modal_mensaje_ver_admin( <?= $row['id'] ?>)">Ver</button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

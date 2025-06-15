<?php
require("conexion.php"); // Conectar a la BD

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el ID

    // Preparar y ejecutar la eliminación
    $sql = $con->prepare("DELETE FROM mensajes WHERE id = ?");
    $sql->bind_param("i", $id);
    
    if ($sql->execute()) {
        echo "Mensaje eliminado correctamente.";
    } else {
        echo "Error al eliminar el mensaje.";
    }

    $sql->close();
    $con->close();
    
} else {
    echo "ID de mensaje no proporcionado.";
}
?>
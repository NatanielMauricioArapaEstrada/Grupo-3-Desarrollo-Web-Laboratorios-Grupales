<?php
include('conexion.php');

$id = $_GET['id'];

// 1. Eliminar mensajes donde el usuario sea remitente
$con->query("DELETE FROM mensajes WHERE id_remitente = $id");

// 2. Eliminar mensajes donde el usuario sea destinatario
$con->query("DELETE FROM mensajes WHERE id_destinatario = $id");

// 3. Finalmente, eliminar el usuario
$sql = "DELETE FROM usuario WHERE id = $id";
$resultado = $con->query($sql);

if ($resultado) {
    echo "<span>Registro eliminado correctamente</span>";
} else {
    echo "Error al eliminar";
}
?>

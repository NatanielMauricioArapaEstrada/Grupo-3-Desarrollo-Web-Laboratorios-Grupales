<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT estado FROM usuario WHERE id = $id";
    $resultado = $con->query($sql);
    if ($fila = $resultado->fetch_assoc()) {
        $nuevoEstado = $fila['estado'] == '0' ? '1' : '0';
        $sqlUpdate = "UPDATE usuario SET estado = '$nuevoEstado' WHERE id = $id";
        $con->query($sqlUpdate);
        echo "Estado actualizado correctamente";
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "ID no proporcionado";
}
?>

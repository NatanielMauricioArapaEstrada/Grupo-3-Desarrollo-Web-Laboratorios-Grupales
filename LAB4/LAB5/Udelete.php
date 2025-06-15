<?php
include('conexion.php');

$id = $_GET['id'];


// 3. Finalmente, eliminar el usuario
$sql = "DELETE FROM usuarios WHERE id = $id";

$resultado = $con->query($sql);

if ($resultado) {
    echo "<span>Usuario eliminado correctamente</span>";
} else {
    echo "Error al eliminar";
}
?>

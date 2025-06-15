<?php
include("conexion.php");
$sql = "SELECT id, nombre, correo FROM usuario";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['nombre']} ({$row['correo']})</option>";
}

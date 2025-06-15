<?php
session_start();
include('conexion.php');

$id = $_GET['id'];
$sql = "SELECT id, nombre, correo, password, nivel, estado FROM usuario WHERE id=$id";
$resultado = $con->query($sql);
$fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="javascript:UEditar()" method="post" id="FormUpdate">
        <form action="javascript:guardarEditar()" id="form-edit" method="post" >
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>"><br>
        <label>Correo</label>
        <input type="email" name="correo" value="<?php echo $fila['correo']; ?>"><br>
        <label>Contraseña</label>
        <input type="password" name="password" value="<?php echo $fila['password']; ?>"><br>
        <label>Nivel</label>
<select name="nivel">
    <option value="0" <?php if ($fila['nivel'] == 0) echo 'selected'; ?>>Administrador</option>
    <option value="1" <?php if ($fila['nivel'] == 1) echo 'selected'; ?>>Usuario</option>
</select><br>
        <label>Estado</label>
        <select name="estado">
            <option value="1" <?php if($fila['estado'] == 1) echo 'selected'; ?>>Activo</option>
            <option value="0" <?php if($fila['estado'] == 0) echo 'selected'; ?>>Inactivo</option>
        </select><br>
        <button type="submit">Actualizar Usuario</button>
        </form>
    </form>
</body>
</html>
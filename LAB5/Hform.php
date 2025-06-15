<?php
include('conexion.php');
$sqlTipos = "SELECT id, nombre FROM tipohabitacion";
$sqlTiposImagenes = "SELECT id, imagen FROM imageneshabitaciones";
$resultTipos = $con->query($sqlTipos);
$resultTiposImagenes = $con->query($sqlTiposImagenes);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   
    <form id="formulario" onsubmit="Hinsertar(); return false;" method="post" enctype="multipart/form-data">
    <label for="descripcion">Descripcion</label>
    <input type="text" id="descripcion" name="descripcion"><br>

    <label for="numero">Numero:</label>
    <input type="number" id="numero" name="numero"><br>

    <label for="piso">Piso:</label>
    <input type="number" id="piso" name="piso"><br>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
        <option value="0">Libre</option>
        <option value="1">Ocupado</option>
    </select><br>

    <label for="tipoHabitacion">Tipo de habitacion:</label>
    <select id="tipoHabitacion" name="tipoHabitacion" required>
        <?php while ($fila = $resultTipos->fetch_assoc()) { ?>
            <option value="<?= $fila['id'] ?>"><?= $fila['nombre'] ?></option>
        <?php } ?>
    </select><br>

    <label for="imagen">Imagen:</label>
    <select id="imagen" name="imagen" onchange="mostrarVistaPrevia()">
        <option value="">Seleccione una imagen</option>
        <?php while ($filaImagen = $resultTiposImagenes->fetch_assoc()) { ?>
            <option value="<?= $filaImagen['id'] ?>"><?= $filaImagen['imagen'] ?></option>
        <?php } ?>
    </select><br>

    <div>
       <img id="vistaPrevia" style="width: 100px; height: 100px; display: none;">
    </div>

    <input type="submit" value="Enviar">
</form>


</body>
</html>
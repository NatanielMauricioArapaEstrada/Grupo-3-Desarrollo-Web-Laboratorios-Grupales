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
   
    <form id="formulario"  onsubmit="Hinsertar();" method="post">
        <label for="descripcion">Descripcion</label>
        <input type="text" id="descripcion" name="descripcion"><br>
        <label for="numero">Numero:</label>
        <input type="number" id="numero" name="numero"><br>
        <label for="piso">Piso:</label>
        <input type="number" id="piso" name="piso"><br>
        <label for="estado">Estado</label>
        <input type="text" id="estado" name="estado"><br>
        <label for="tipoHabitacion">Tipo de habitacion:</label>
        <select id="tipoHabitacion" name="tipoHabitacion" required>
            <?php while ($fila = $resultTipos->fetch_assoc()) { ?>
                <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
            <?php } ?>
        </select><br>
        <label for="imagen">Imagen:</label>
        <select id="imagen" name="imagen" onchange="mostrarVistaPrevia()">
            <option value="">Seleccione una imagen</option>
            <?php while ($filaImagen = $resultTiposImagenes->fetch_assoc()) { ?>
                <option value="<?php echo $filaImagen['id']; ?>"><?php echo $filaImagen['imagen']; ?></option>
            <?php } ?>
        </select><br>
        <div>
           <img id="vistaPrevia" style="width: 100px; height: 100px; display: none;">
        </div>
        <input type="submit" value="Enviar">
    </form>

</body>
</html>
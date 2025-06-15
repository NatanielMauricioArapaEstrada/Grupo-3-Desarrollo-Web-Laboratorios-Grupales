<?php
session_start();
include('conexion.php');

$id = $_GET['id'];
$sql = "SELECT * FROM habitaciones WHERE id = $id";
$result = $con->query($sql);

$sqlTipos = "SELECT id, nombre FROM tipohabitacion";
$sqlTiposImagenes = "SELECT id, imagen FROM imageneshabitaciones";
$resultTipos = $con->query($sqlTipos);
$resultTiposImagenes = $con->query($sqlTiposImagenes);

$fila = $result->fetch_assoc();
?>  
    <form id="formulario"  onsubmit="Hactualizar();" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>">
        <label for="descripcion">Descripcion</label>
        <input type="text" id="descripcion" name="descripcion"><br>
        <label for="numero">Numero</label>
        <input type="number" id="numero" name="numero" value="<?php echo $fila['numero']; ?>"><br>
        <label for="piso">Piso</label>
        <input type="number" id="piso" name="piso" value="<?php echo $fila['piso']; ?>"><br>
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="0" <?php echo ($fila['estado'] == 0) ? 'selected' : ''; ?>>Ocupado</option>
            <option value="1" <?php echo ($fila['estado'] == 1) ? 'selected' : ''; ?>>Libre</option>
        </select><br>
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
        <input type="submit" value="Actualizar">
    </form>
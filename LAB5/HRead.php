<?php 
include('conexion.php');

$sql = "SELECT 
  th.id,
  th.descripcion,
  th.numero,
  th.piso,
  th.estado,
  th.id_imagen,
  h.nombre,
  h.superficie,
  h.nrocamas,
  ih.imagen
FROM habitaciones th
JOIN tipohabitacion h ON h.id = th.id_tipohabitacion
LEFT JOIN imageneshabitaciones ih ON ih.id = th.id_imagen";

$result = $con->query($sql);?>

    <table border=1>
    <tr>
        <td>ID</td>
        <td>Descripcion</td>
        <td>Numero</td>
        <td>Piso</td>
        <td>Estado</td>
        <td>Nombre</td>
        <td>Superficie</td>
        <td>Numero de camas</td>
        <td>Imagen</td>
        <td>Acciones</td>
    </tr>
    <?php
    while ($fila = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['descripcion']; ?></td>
            <td><?php echo $fila['numero']; ?></td>
            <td><?php echo $fila['piso']; ?></td>
            <td><?php echo ($fila['estado'] == 1) ? "Ocupado" : "Libre"; ?></td>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['superficie']; ?></td>
            <td><?php echo $fila['nrocamas']; ?></td>
            <td>
                <?php
                if ($fila['imagen']) {
                    echo "<img src='imagenes/" . $fila['imagen'] . "' alt='Imagen' style='width: 100px; height: 100px;'>";
                } else {
                    echo "No hay imagen";
                }
                ?>
            <td><button onclick="editar(<?php echo $fila['id']; ?>)">Editar</button></td>
            <td><button onclick="confirmarEliminacion(<?php echo $fila['id']; ?>)">Eliminar</button></td>
        </tr>
        <?php
    }
    ?>
</table>


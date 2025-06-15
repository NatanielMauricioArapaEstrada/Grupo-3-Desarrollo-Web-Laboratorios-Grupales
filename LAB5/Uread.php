<?php
include('conexion.php');
session_start();
//$id_usuario=$_SESSION['id_usuario'];
$sql = "SELECT id, correo, password, nivel FROM usuarios ";
$resultado = $con->query($sql);
//where id!=$id_usuario
?>
<div >

   <button onclick="mostrarModalCreate()">Crear Usuario</button><br><br>


    <table>
        <tr>
            <td>ID</td>
            <td>Correo</td>
            <td>Nivel</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
        <?php while($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $fila['id'] ?></td>
            
                <td><?= $fila['correo'] ?></td>
                <td><?= $fila['nivel'] == '0' ? "Administrador" : "Usuario" ?></td>
            
                <td><a href="javascript:mostrarModalUpdate(<?= $fila['id'] ?>)">Editar Usuario</a></td>
                <td><a style="background-color:rgb(238, 85, 85)" href="javascript:mostrarModalDelete(<?= $fila['id'] ?>)">Eliminar Usuario</a></td>
            </tr>
        <?php } ?>
    </table>

</div>
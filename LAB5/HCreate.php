<?php 
include('conexion.php');


$descripcion        = $_POST['descripcion'];
$numero             = $_POST['numero'];
$piso               = $_POST['piso'];
$estado             = $_POST['estado'];            
$id_tipohabitacion  = $_POST['tipoHabitacion'];
$id_imagen          = $_POST['imagen'];


$sql = "INSERT INTO habitaciones 
    (descripcion, numero, piso, estado, id_tipohabitacion, id_imagen) 
  VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error en la preparación: " . $con->error);
}


$stmt->bind_param(
    "siiiis",
    $descripcion,
    $numero,
    $piso,
    $estado,
    $id_tipohabitacion,
    $id_imagen
);


if ($stmt->execute()) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>

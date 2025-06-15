<?php 
include('conexion.php');
$id = $_GET['id'];
$sql = "DELETE FROM habitaciones WHERE id = $id";
$con->query($sql);
?>
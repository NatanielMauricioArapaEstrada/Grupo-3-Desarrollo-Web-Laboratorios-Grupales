<?php
session_start();
include("conexion.php");

$correo = $_POST['correo'];
$password = sha1($_POST['password']);

$stmt = $con->prepare('SELECT id, correo, nombre, nivel, estado FROM usuario WHERE correo=? AND password=?');
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Guardamos todo lo necesario en sesión
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['correo']     = $usuario['correo'];
    $_SESSION['nombre']     = $usuario['nombre'];
    $_SESSION['nivel']      = $usuario['nivel'];
    $_SESSION['estado']      = $usuario['estado'];
    header("Location: pagina.php");
    exit();
} else {
    echo "Error: datos de autenticación incorrectos.";
    ?>
    <meta http-equiv="refresh" content="3;url=login.html">
    <?php
}
?>

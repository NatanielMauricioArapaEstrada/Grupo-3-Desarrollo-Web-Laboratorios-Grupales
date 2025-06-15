<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST["asunto"];
    $descripcion = $_POST["descripcion"];
    $id_destinatario = $_POST["id_destinatario"];
    $id_remitente = $_SESSION["id_usuario"]; // ya definido en tu sesión
    $estado = "no_leido";

    $sql = "INSERT INTO mensajes (asunto, descripcion, id_destinatario, id_remitente, estado)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssiis", $asunto, $descripcion, $id_destinatario, $id_remitente, $estado);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Mensaje enviado correctamente.</p>";
    } else {
        echo "<p style='color:red;'>Error al enviar el mensaje.</p>";
    }

    $stmt->close();
}
?>

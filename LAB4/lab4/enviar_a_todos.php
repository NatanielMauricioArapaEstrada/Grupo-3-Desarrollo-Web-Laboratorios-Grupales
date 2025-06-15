<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["status" => "error", "msg" => "No hay sesión"]);
    exit;
}

header("Content-Type: application/json");



$data = json_decode(file_get_contents("php://input"), true);
$asunto = $data["asunto"];
$descripcion = $data["descripcion"];
$id_remitente = $_SESSION['id_usuario'];

try {
    $sql = "SELECT id FROM usuario WHERE estado = 1 AND id != ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_remitente);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $id_destinatario = $row['id'];

        $insert = $con->prepare("INSERT INTO mensajes (asunto, descripcion, estado, id_remitente, id_destinatario) VALUES (?, ?, 'no_leido', ?, ?)");
        $insert->bind_param("ssii", $asunto, $descripcion, $id_remitente, $id_destinatario);
        $insert->execute();
    }

    echo json_encode(["exito" => true]);

} catch (Exception $e) {
    echo json_encode(["exito" => false, "error" => $e->getMessage()]);
}
?>

<?php
include("conexion.php");

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];

    $sql = "SELECT 
            h.id AS id_habitacion,
            h.descripcion,
            h.numero,
            h.piso,
            th.nombre AS tipo_nombre,
            th.superficie,
            th.nrocamas,
            ih.imagen
        FROM habitaciones h
        INNER JOIN tipohabitacion th ON h.id_tipohabitacion = th.id
        LEFT JOIN imageneshabitaciones ih ON h.id_imagen = ih.id
        WHERE th.nombre = ? AND h.estado = 0
        ORDER BY ih.orden ASC";


    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $tipo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        session_start();
       echo '<div class="features-grid">';

while ($fila = $resultado->fetch_assoc()) {
    $tipo = strtolower($fila['tipo_nombre']);
    $precio = '';

    if ($tipo === 'simple') {
        $precio = '$50 por noche';
    } elseif ($tipo === 'doble') {
        $precio = '$80 por noche';
    } elseif ($tipo === 'suite') {
        $precio = '$150 por noche';
    } else {
        $precio = 'Consultar precio';
    }

    echo '
    <div class="card" style="width: 18rem; margin: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <img src="imagenes/' . $fila['imagen'] . '" class="card-img-top" alt="Habitación" style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 180px; object-fit: cover;">
        
        <div class="card-body">
            <h5 class="card-title">Habitación ' . $fila['tipo_nombre'] . '</h5>
            <p class="card-text">' . $fila['descripcion'] . '</p>
            <p><strong>Incluye:</strong></p>
            <ul style="padding-left: 20px;">
                <li><strong>Piso:</strong> ' . $fila['piso'] . '</li>
                <li><strong>Número:</strong> ' . $fila['numero'] . '</li>
                <li><strong>Superficie:</strong> ' . $fila['superficie'] . ' m²</li>
                <li><strong>N° Camas:</strong> ' . $fila['nrocamas'] . '</li>
            </ul>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Precio:</strong> ' . $precio . '</li>
        </ul>

        <div class="card-body">';
        
        if (isset($_SESSION['id_usuario'])) {
            echo '<a href="#" onclick="abrirModalReserva(' . $fila['id_habitacion'] . ')" class="card-link">Reservar</a>';
        } else {
            echo '<a href="#" onclick="abrirModal(\'login.html\')" class="card-link">Iniciar sesión para reservar</a>';
        }

    echo '
        </div>
    </div>';
}

echo '</div>'; 



    } else {
        echo "<p>No se encontraron habitaciones disponibles del tipo '$tipo'.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Error: Tipo de habitación no recibido.</p>";
}
?>

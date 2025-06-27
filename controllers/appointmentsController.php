<?php
// controllers/appointmentsController.php
require_once '../config/database.php'; // Incluir la conexión a la base de datos

function createAppointment($date, $time, $clientName) {
    global $pdo;

    // Verifica si ya existe una cita en esa fecha y hora
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE date = ? AND time = ?");
    $stmt->execute([$date, $time]);
    $existingAppointment = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si ya existe, no se crea la cita
    if ($existingAppointment) {
        return false;
    }

    // Si no existe, inserta la nueva cita
    $stmt = $pdo->prepare("INSERT INTO appointments (date, time, client_name) VALUES (?, ?, ?)");
    return $stmt->execute([$date, $time, $clientName]); // Inserta la cita en la base de datos
}

?>

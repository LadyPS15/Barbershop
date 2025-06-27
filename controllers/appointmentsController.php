<?php
// Corregido con la ruta correcta para incluir la conexión a la base de datos
require_once '../config/database.php'; 

// Función para crear una cita con servicios
function createAppointment($client_id, $barber_id, $date, $time, $service_ids) {
    global $pdo;

    // Verifica si ya existe una cita en esa fecha y hora con el mismo barbero
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE date = ? AND time = ? AND barber_id = ?");
    $stmt->execute([$date, $time, $barber_id]);
    $existingAppointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingAppointment) {
        return false; // Ya existe una cita en esa fecha y hora con ese barbero
    }

    // Inserta la nueva cita
    $stmt = $pdo->prepare("INSERT INTO appointments (client_id, barber_id, date, time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$client_id, $barber_id, $date, $time]);
    $appointment_id = $pdo->lastInsertId(); // Obtiene el ID de la nueva cita

    // Insertar los servicios asociados a la cita
    $total_price = 0;
    foreach ($service_ids as $service_id) {
        // Obtener el precio del servicio basado en el barbero
        $stmt = $pdo->prepare("SELECT base_price FROM services WHERE id = ?");
        $stmt->execute([$service_id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        $service_price = $service['base_price'];

        // Insertar el servicio asociado a la cita
        $stmt = $pdo->prepare("INSERT INTO appointment_services (appointment_id, service_id, barber_id, service_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$appointment_id, $service_id, $barber_id, $service_price]);
        
        $total_price += $service_price;
    }

    // Actualizar el precio total de la cita en la tabla appointments
    $stmt = $pdo->prepare("UPDATE appointments SET total_price = ? WHERE id = ?");
    $stmt->execute([$total_price, $appointment_id]);

    return true; // Cita creada con éxito
}
?>

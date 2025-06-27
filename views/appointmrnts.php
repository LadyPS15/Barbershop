<?php
// views/appointments.php
require_once '../controllers/appointmentsController.php'; // Incluir controlador de citas

// Verificar si el formulario fue enviado (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['client_name']; // Nombre del cliente ingresado manualmente
    $client_phone = $_POST['client_phone']; // Número de celular ingresado manualmente
    $barber_id = $_POST['barber_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service_ids = $_POST['services']; // Array de servicios seleccionados

    // Verificar si el cliente ya existe
    $stmt = $pdo->prepare("SELECT id FROM clients WHERE client_name = ?");
    $stmt->execute([$client_name]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si el cliente no existe, lo creamos
    if (!$client) {
        $default_email = "noemail@domain.com"; // Proporcionar un email por defecto
        $stmt = $pdo->prepare("INSERT INTO clients (client_name, email, phone) VALUES (?, ?, ?)");
        $stmt->execute([$client_name, $default_email, $client_phone]); // Ahora también insertamos el teléfono
        $client_id = $pdo->lastInsertId(); // Obtener el ID del nuevo cliente
    } else {
        $client_id = $client['id']; // Usar el ID del cliente existente
    }

    // Llamar a la función para guardar la cita en la base de datos
    $success = createAppointment($client_id, $barber_id, $date, $time, $service_ids);

    if ($success) {
        // Si la cita fue creada correctamente, redirigir al inicio con éxito
        header("Location: ../index.php?success=true");
        exit();
    } else {
        // Si ya existía una cita en esa fecha y hora, redirigir con error
        header("Location: ../index.php?error=true");
        exit();
    }
}
?>

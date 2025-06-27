<?php
// views/appointments.php
require_once '../controllers/appointmentsController.php'; // Incluir controlador de citas

// Verificar si el formulario fue enviado (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $clientName = $_POST['client_name'];

    // Llamar a la función para guardar la cita en la base de datos
    $success = createAppointment($date, $time, $clientName);

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

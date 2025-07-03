<?php
require_once './controllers/adminController.php';

// Verificar si se ha recibido el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['client_id']) && isset($_POST['services'])) {
        $client_id = $_POST['client_id'];
        $services = $_POST['services']; // Array con los precios de los servicios

        // Llamar a la función para actualizar los precios
        $success = updateServicesPrices($client_id, $services);

        if ($success) {
            header("Location: admin.php?success=1"); // Redirigir a admin.php con mensaje de éxito
            exit();
        } else {
            header("Location: admin.php?error=1"); // Redirigir con error
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud incorrecta']);
}

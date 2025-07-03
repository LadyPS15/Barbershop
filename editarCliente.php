<?php
require_once './controllers/adminController.php';

// Verificar si se ha recibido un ID de cliente en la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Cliente no encontrado.";
    exit();
}

$client_id = $_GET['id'];

// Obtener los servicios asociados al cliente
$services = getServicesByClientId($client_id);

// Si no hay servicios asociados, mostrar mensaje
if (!$services) {
    echo "No se encontraron servicios para este cliente.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editar.css">
    <title>Editar Servicios del Cliente</title>
</head>
<body>
    <h2>Editar Servicios del Cliente</h2>

    <form action="editServiceHandler.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

        <!-- Mostrar solo los servicios asociados a la cita -->
        <?php foreach ($services as $service): ?>
            <div>
                <label for="service_<?php echo $service['id']; ?>"><?php echo $service['service_name']; ?>:</label>
                <input type="number" id="service_<?php echo $service['id']; ?>" name="services[<?php echo $service['id']; ?>]" value="<?php echo $service['service_price']; ?>" required step="0.01">
            </div>
        <?php endforeach; ?>

        <button type="submit">Actualizar Precios</button>
    </form>

    <a href="admin.php">Volver al panel</a>
</body>
</html>

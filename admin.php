<?php
session_start(); // Iniciar sesión

// Verificar si el administrador está autenticado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

require_once './controllers/adminController.php'; // Incluir controlador

// Obtener los clientes frecuentes y los ingresos del mes
$frequentClients = getFrequentClients();
$monthlyIncome = getMonthlyIncome();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
</head>
<body>
    <h2>Panel de Administración</h2>
    <h3>Hola, Admin</h3>

    <h3>Clientes Frecuentes</h3>
    <ul>
        <?php foreach ($frequentClients as $client): ?>
            <li><?php echo $client['client_name']; ?> - <?php echo $client['visits']; ?> visitas</li>
        <?php endforeach; ?>
    </ul>

    <h3>Ingresos del Mes</h3>
    <p><?php echo $monthlyIncome['total_income']; ?> USD</p>
    
    <a href="logout.php">Cerrar sesión</a> <!-- Cerrar sesión -->
</body>
</html>

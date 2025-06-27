<?php
session_start(); // Iniciar sesión

// Verificar si el administrador está autenticado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

require_once './controllers/adminController.php'; // Incluir controlador

// Obtener los clientes frecuentes y los ingresos del mes
$frequentClients = getFrequentClients(); // Llamar a la función para obtener los clientes frecuentes
$monthlyIncome = getMonthlyIncome();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="assets/css/admin.css"> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Incluir Chart.js para la gráfica -->
</head>
<body>
    <div class="header">
        <h3>Hola, Admin</h3>
    </div>

    <h2>Panel de Administración</h2>

    <h3>Clientes Frecuentes</h3>
    <!-- Tabla de Clientes Frecuentes -->
<table class="frequent-clients-table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Visitas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($frequentClients as $client): ?>
            <tr>
                <td><?php echo $client['client_name']; ?></td>
                <td><?php echo $client['visits']; ?></td>
                <td>
                        <a href="">Editar</a> | 
                        <a href="">Cancelar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <h3>Ingresos del Mes</h3>
    <canvas id="incomeChart" width="400" height="200"></canvas> <!-- Gráfica de ingresos -->

    <a href="logout.php">Cerrar sesión</a> <!-- Cerrar sesión -->

    <script>
        // Crear la gráfica de ingresos del mes utilizando Chart.js
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ingresos del mes'], // En una implementación más dinámica, aquí podrías agregar los días o semanas del mes
                datasets: [{
                    label: 'Ingresos',
                    data: [<?php echo $monthlyIncome['total_income']; ?>],
                    backgroundColor: '#4287f5',
                    borderColor: '#3465e6',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

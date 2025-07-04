<?php
session_start();

// Verificar si el administrador está autenticado
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php");
    exit();
}

require_once './controllers/adminController.php'; // Incluir controlador

// Obtener los clientes frecuentes
$frequentClients = getFrequentClients(); 

// Obtener los ingresos del mes
$monthlyIncome = getMonthlyIncome(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="assets/css/admin.css"> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">
        <h3>Hola, Admin</h3>
    </div>

    <h2>Panel de Administración</h2>

    <div class="dashboard-container">
        <!-- Sección de Clientes Frecuentes -->
        <div class="clients-section">
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
                            <td><?php echo htmlspecialchars($client['client_name']); ?></td>
                            <td><?php echo $client['visits']; ?></td>
                            <td>
                                <a href="editarCliente.php?id=<?php echo urlencode($client['id']); ?>">Editar Servicios</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Sección de Ingresos del Mes -->
        <div class="income-section">
            <h3>Ingresos del Mes</h3>
            <canvas id="incomeChart" width="400" height="200"></canvas> <!-- Gráfica de ingresos -->
        </div>
    </div>

    <a href="logout.php" class="logout">Cerrar sesión</a>

    <script>
        // Crear la gráfica de ingresos del mes utilizando Chart.js
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ingresos del mes'],
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

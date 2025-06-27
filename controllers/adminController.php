<?php
require_once 'config/database.php'; // Incluir la conexión a la base de datos

// Función para obtener los clientes frecuentes
function getFrequentClients() {
    global $pdo;
    $stmt = $pdo->query("SELECT client_name, COUNT(*) as visits FROM appointments GROUP BY client_name ORDER BY visits DESC LIMIT 3");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los clientes más frecuentes
}

// Función para obtener los ingresos del mes
function getMonthlyIncome() {
    global $pdo;
    $stmt = $pdo->query("SELECT SUM(price) as total_income FROM appointments WHERE MONTH(date) = MONTH(CURRENT_DATE())");
    return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve los ingresos del mes
}
?>

<?php
require_once 'config/database.php'; // Incluir la conexión a la base de datos

// Función para obtener los clientes frecuentes
function getFrequentClients() {
    global $pdo;
    // Obtenemos los clientes más frecuentes basados en el número de citas
    $stmt = $pdo->query("SELECT client_name, COUNT(*) as visits 
                         FROM appointments 
                         INNER JOIN clients ON appointments.client_id = clients.id
                         GROUP BY client_name 
                         ORDER BY visits DESC 
                         LIMIT 5");  // Limitar a los 5 clientes más frecuentes
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve los clientes frecuentes
}

// Función para obtener todos los barberos
function getAllBarbers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM barbers");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los barberos
}

// Función para obtener todos los servicios
function getAllServices() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM services");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los servicios
}
// Función para obtener los ingresos del mes
function getMonthlyIncome() {
    global $pdo;
    $stmt = $pdo->query("SELECT SUM(total_price) as total_income FROM appointments WHERE MONTH(date) = MONTH(CURRENT_DATE())");
    return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve los ingresos del mes
}
?>

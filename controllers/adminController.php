<?php
require_once 'config/database.php'; // Incluir la conexión a la base de datos

// Función para obtener los clientes frecuentes
function getFrequentClients() {
    global $pdo;
    // Asegúrate de seleccionar la columna 'id' de la tabla 'clients'
    $stmt = $pdo->query("SELECT clients.id, clients.client_name, COUNT(*) as visits
                         FROM appointments
                         INNER JOIN clients ON appointments.client_id = clients.id
                         GROUP BY clients.id, clients.client_name
                         ORDER BY visits DESC 
                         LIMIT 5");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve los clientes frecuentes con el 'id'
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

// controllers/adminController.php

// Función para obtener los servicios de un cliente específico
function getServicesByClientId($client_id) {
    global $pdo;

    // Obtenemos los servicios que están asociados a las citas del cliente
    $stmt = $pdo->prepare("
        SELECT 
            services.id, 
            services.service_name, 
            appointment_services.service_price
        FROM appointment_services
        INNER JOIN services ON appointment_services.service_id = services.id
        WHERE appointment_services.appointment_id IN (
            SELECT id FROM appointments WHERE client_id = ?
        )
    ");
    $stmt->execute([$client_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los servicios asociados a las citas del cliente
}

// Función para actualizar los precios de los servicios de un cliente
function updateServicesPrices($client_id, $services) {
    global $pdo;

    // Actualizar cada precio de los servicios asociados al cliente
    foreach ($services as $service_id => $new_price) {
        $stmt = $pdo->prepare("
            UPDATE appointment_services 
            SET service_price = ? 
            WHERE service_id = ? 
            AND appointment_id IN (SELECT id FROM appointments WHERE client_id = ?)
        ");
        $stmt->execute([$new_price, $service_id, $client_id]);
    }

    return true; // Precios actualizados correctamente
}
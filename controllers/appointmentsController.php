<?php
// controllers/appointmentsController.php
require_once 'config/database.php';

function getAppointmentsByDate($date) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE date = ?");
    $stmt->execute([$date]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createAppointment($date, $time, $clientName) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO appointments (date, time, client_name) VALUES (?, ?, ?)");
    $stmt->execute([$date, $time, $clientName]);
}
?>

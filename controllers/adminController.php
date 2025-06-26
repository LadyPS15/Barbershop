<?php
// controllers/adminController.php
require_once 'config/database.php';

function getFrequentClients() {
    global $pdo;
    $stmt = $pdo->query("SELECT client_name, COUNT(*) as visits FROM appointments GROUP BY client_name ORDER BY visits DESC LIMIT 3");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMonthlyIncome() {
    global $pdo;
    $stmt = $pdo->query("SELECT SUM(price) as total_income FROM appointments WHERE MONTH(date) = MONTH(CURRENT_DATE())");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

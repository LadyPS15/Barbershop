<?php
// admin.php
require_once 'controllers/adminController.php';

$frequentClients = getFrequentClients();
$monthlyIncome = getMonthlyIncome();

include 'views/adminPanel.php';
?>

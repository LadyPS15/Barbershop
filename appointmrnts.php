<?php
// appointments.php
require_once 'controllers/appointmentsController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $clientName = $_POST['client_name'];

    createAppointment($date, $time, $clientName);
    header("Location: index.php");
    exit();
}
?>

<?php include '/views/partials/header.php'; ?>

<h2>Reserva tu Cita</h2>
<form action="/views/appointmrnts.php" method="POST">
    <label for="date">Selecciona la fecha:</label>
    <input type="date" name="date" required>
    
    <label for="time">Selecciona la hora:</label>
    <input type="time" name="time" required>
    
    <label for="client_name">Tu Nombre:</label>
    <input type="text" name="client_name" required>
    
    <button type="submit">Reservar</button>
</form>

<?php include '/views/partials/footer.php'; ?>

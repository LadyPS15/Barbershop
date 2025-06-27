<?php include 'views/partials/header.php'; ?>

<link rel="stylesheet" href="assets/css/styles.css"> 

<section id="servicios">
    <h2>Nuestros Servicios</h2>
    <div class="service-list">
        <div class="service-item">
            <h3>Corte de Cabello</h3>
            <p>Disfruta de un corte de cabello profesional que se adapta a tu estilo.</p>
            <img src="assets/image/SERVICIO1.png" alt="Corte de Cabello">
            </div>
        <div class="service-item">
            <h3>Afeitado Clásico</h3>
            <p>Un afeitado limpio y cómodo, utilizando productos de la más alta calidad.</p>
        <img src="assets/image/SERVICIO3.png" alt="Afeitado Clásico">
        </div>
        <div class="service-item">
            <h3>Tratamiento Capilar</h3>
            <p>Cuida tu cabello con nuestros tratamientos especializados para cada tipo de pelo.</p>
            <img src="assets/image/SERVICIO2.png" alt="Tratamiento Capilar">
        </div>
    </div>
</section>

<section id="productos">
    <h2>Productos Destacados</h2>
    <div class="product-list">
        <div class="product-item">
            <h3>Cera ultrafuerte</h3>
            <p>Cera de alta calidad para mantener tu estilo todo el día.</p>
            <img src="assets/image/PRODUCTO2.png" alt="Cera ultrafuerte">
        </div>
        <div class="product-item">
            <h3>Proraso</h3>
            <p>Protege y nutre tu cabello con nuestro acondicionador premium.</p>
            <img src="assets/image/PRODUCTO1.png" alt="Proraso">
        </div>
        <div class="product-item">
            <h3>Polvo voluminizador</h3>
            <p>La mejor marca para después del afeitado</p>
            <img src="assets/image/PRODUCTO4.png" alt="Polvo voluminizador">
        </div>
    </div>
</section>

<section id="reserva">
    <h2>Reserva tu Cita</h2>

    <!-- Mostrar mensaje de éxito si la cita fue creada -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
        <p style="color:green;">¡Cita reservada con éxito!</p>
    <?php endif; ?>

    <!-- Mostrar mensaje de error si ya existe una cita en esa fecha y hora -->
    <?php if (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
        <p style="color:red;">Ya existe una cita en esta fecha y hora. Por favor, elige otro horario.</p>
    <?php endif; ?>

    <!-- Formulario para la reserva de citas -->
    <form action="views\appointmrnts.php" method="POST">
        <label for="date">Selecciona la fecha:</label>
        <input type="date" name="date" required>
        
        <label for="time">Selecciona la hora:</label>
        <input type="time" name="time" required>
        
        <label for="client_name">Tu Nombre:</label>
        <input type="text" name="client_name" required>
        
        <button type="submit">Reservar</button>
    </form>
</section>


<?php include 'views/partials/footer.php'; ?> 
